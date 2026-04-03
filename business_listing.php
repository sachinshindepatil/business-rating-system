<div class="container mt-5">

    <div class="d-flex justify-content-between mb-3">
        <h3>Business List</h3>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#businessModal" onclick="clearForm()">
            <i class="fa fa-plus"></i> Add
        </button>
    </div>

    <table id="businessTable" class="table table-hover table-bordered" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Business Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Average Rating</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>


    <!-- Business Modal -->
    <div class="modal fade" id="businessModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Add Business</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="businessForm">
                    <div class="modal-body">
                        <input type="hidden" id="business_id" name="business_id" value="">

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Business Name :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="business_name" id="name" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Address :</label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="address" id="address"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Phone :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone" id="phone">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Email :</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" name="email" id="email">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="ratingModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Your FeedBack ! </h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="ratingForm">
                    <div class="modal-body">
                        <input type="hidden" name="rating_business_id" id="rating_business_id">

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Name :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="rating_name" id="rating_name" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Email :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="email" id="email" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Phone :</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="phone" id="phone" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Rating :</label>
                            <div class="col-sm-8">
                                <div id="rating_value"></div>
                                <span id="rating_error" style="color:red; font-size: 13px;  margin-top: 4px;font-weight: 500; display:none;">
                                    Please select rating
                                </span>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>