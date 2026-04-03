var table;

$(document).ready(function () {

    table = $('#businessTable').DataTable({
        processing: true,
        ajax: {
            url: "api.php?route=business-list",
            type: "GET"
        },
        columns: [
            {
                data: null,
                render: (data, type, row, meta) => meta.row + 1
            },
            { data: "name" },
            { data: "address" },
            { data: "phone" },
            { data: "email" },
            {
                data: "rating",
                orderable: false,
                searchable: false,
               render: function(data, type, row){
                    return `
                        <div class="rating"
                            data-score="${data}"
                            onclick="openRatingModal('${row.id}', '${data}')">
                        </div>
                    `;
                }
            },
            {
                data: null,
                orderable: false,
                searchable: false,
                render: function(data, type, row){
                     return `
                        <button class="btn btn-primary btn-sm me-1"
                            onclick="editBusiness('${row.id}','${row.name}','${row.address}','${row.phone}','${row.email}')">
                            <i class="fa fa-edit"></i>
                        </button>
                    
                        <button class="btn btn-danger btn-sm"
                            onclick="deleteBusiness('${row.id}')">
                            <i class="fa fa-trash"></i>
                        </button>
                    `;
                }
            },
        ],
        drawCallback: function(){
            $('.rating').each(function(){
                if($(this).data('raty')){
                    $(this).raty('destroy');
                }
                $(this).html('');
                // initialize raty
                $(this).raty({
                    score: function(){
                        return $(this).attr("data-score");
                    },
                    number: 5,
                    half: true,
                    readOnly: true,
                    path: "assets/images"
                });
            });
        }
    });

    $("#businessForm").validate({
        ignore: [],
        rules: {
            business_name: {
                required: true,
                minlength: 3
            },
            address: {
                required: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            },
            email: {
                required: true,
                email: true
            }
        },

        messages: {
            business_name: {
                required: "Please Enter Business Name",
                minlength: "Minimum 3 characters required"
            },
            address: {
                required: "Please Enter Address"
            },
            phone: {
                required: "Please Enter Phone number",
                digits: "Only Numbers Allowed",
                minlength: "Phone must be 10 digits",
                maxlength: "Phone must be 10 digits"
            },
            email: {
                required: "Please Enter email",
                email: "Enter valid email"
            }
        },

        submitHandler: function(form) {
            save_data();
        }
    });

    $("#ratingForm").validate({
        rules: {
            rating_name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 10
            }
        },

        messages: {
            rating_name: {
                required: "Please Enter Business Name",
                minlength: "Minimum 3 characters required"
            },
            email: {
                required: "Please Enter email",
                email: "Enter valid email"
            },
            phone: {
                required: "Please Enter Phone number",
                digits: "Only Numbers Allowed",
                minlength: "Phone must be 10 digits",
                maxlength: "Phone must be 10 digits"
            }
        },

        submitHandler: function(form){
            var rating = $("input[name='rating']").val();
            if(!rating || rating == 0){
                $("#rating_error").show();
                return false;
            }
            $("#rating_error").hide();
            save_rating();
        }

    });
    
});


function save_data(){

    var formdata = new FormData($("#businessForm")[0]);

    $.ajax({
        url: "api.php?route=save-business",
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        dataType: "json",

        success: function(res){

            if(res.status){
                $("#businessModal").modal("hide");
                $("#businessForm")[0].reset();
                table.ajax.reload(null,false);
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        },

        error: function(){
            toastr.error("Something went wrong!");
        }

    });
}

// Edit Details on Form
function editBusiness(id, name, address, phone, email){
    var validator = $("#businessForm").validate();
    validator.resetForm();
    $("#business_id").val(id);
    $("#name").val(name);
    $("#address").val(address);
    $("#phone").val(phone);
    $("#email").val(email);
    $(".modal-title").text("Edit Business");
    $("#businessModal").modal("show");
}

// clearForm
function clearForm() {
    $("#businessForm")[0].reset();
    $("#business_id").val("");
    $(".modal-title").text("Add Business");
    $("#businessModal").modal("show");
}

// delete
function deleteBusiness(id){

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to recover this business!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: "api.php?route=delete-business",
                type: "POST",
                data: { id:id },
                dataType: "json",
                success:function(res){
                    if(res.status){
                        toastr.success(res.message);
                        table.ajax.reload(null,false);
                    }else{
                        toastr.error(res.message);
                    }
                },
                error:function(){
                    toastr.error("Something went wrong !");
                }

            });

        }

    });

}

// rating modal
function openRatingModal(business_id, score){

    $("#rating_business_id").val(business_id);

    // destroy previous raty if already initialized
    if ($("#rating_value").data("raty")) {
        $("#rating_value").raty("destroy");
    }

    // clear previous stars
    $("#rating_value").html('');

    // initialize raty
    $("#rating_value").raty({
        half: true,
        number: 5,
        score: score,
        scoreName: "rating",
        path: "assets/images"
    });

    $("#ratingModal").modal("show");
}

// save_update rating
function save_rating(){

    var formdata = new FormData($("#ratingForm")[0]);

    $.ajax({
        url: "api.php?route=save-rating",
        type: "POST",
        data: formdata,
        processData: false,
        contentType: false,
        dataType: "json",

        success: function(res){

            if(res.status){
                $("#ratingModal").modal("hide");
                $("#ratingForm")[0].reset();
                table.ajax.reload(null,false);
                toastr.success(res.message);
            }else{
                toastr.error(res.message);
            }
        },

        error: function(){
            toastr.error("Something went wrong!");
        }

    });
}