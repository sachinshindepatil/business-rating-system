<?php

class BusinessModel
{
    private $db;

    public function __construct($link)
    {
        $this->db = $link;
    }

    public function business_list()
    {
        try {
            $query = "SELECT b.id, b.name, b.address, b.phone, b.email,
                    ROUND(IFNULL(AVG(r.rating),0),1) AS rating
                    FROM businesses b
                    LEFT JOIN ratings r 
                    ON b.id = r.business_id
                    GROUP BY b.id, b.name, b.address, b.phone, b.email";

            $stmt = $this->db->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [];
        }
    }

    // ADD / EDIT
    public function add_edit($postData)
    {
        $response = array("status" => false, "message" => "Something went wrong");

        $id      = $postData['business_id'] ?? '';
        $name    = trim($postData['business_name'] ?? '');
        $address = trim($postData['address'] ?? '');
        $phone   = trim($postData['phone'] ?? '');
        $email   = trim($postData['email'] ?? '');

        if ($name === "" || $phone === "" || $email === "") {
            $response["message"] = "Required fields missing";
            return $response;
        }

        try {
            if (empty($id)) {

                $stmt = $this->db->prepare("
                    INSERT INTO businesses (name, address, phone, email)
                    VALUES (:name, :address, :phone, :email)
                ");

                $stmt->execute([
                    ':name'    => $name,
                    ':address' => $address,
                    ':phone'   => $phone,
                    ':email'   => $email
                ]);

                if ($stmt->rowCount() > 0) {
                    return array("status" => true, "message" => "Business added successfully");
                }
            } else {

                $stmt = $this->db->prepare("
                    UPDATE businesses
                    SET name = :name, address = :address, phone = :phone, email = :email
                    WHERE id = :id
                ");

                $stmt->execute([
                    ':name'    => $name,
                    ':address' => $address,
                    ':phone'   => $phone,
                    ':email'   => $email,
                    ':id'      => (int)$id
                ]);

                if ($stmt->rowCount() > 0) {
                    return array("status" => true, "message" => "Business updated successfully");
                } else {
                    return array("status" => false, "message" => "No changes made");
                }
            }
        } catch (PDOException $e) {
            return array("status" => false, "message" => "Database error");
        }

        return $response;
    }

    // Hard Delete
    public function delete($id)
    {
        try {
            $stmt = $this->db->prepare("DELETE FROM businesses WHERE id=?");
            $stmt->execute([$id]);
            return array("status" => true, "message" => "Business deleted successfully");
        } catch (PDOException $e) {
            return array("status" => false, "message" => "Deletetion failed");
        }
    }


    // Rating - Save/Update
    public function save_update($postData)
    {
        $response = array("status" => false, "message" => "Something went wrong");

        $business_id = $postData['rating_business_id'] ?? '';
        $name  = trim($postData['rating_name'] ?? '');
        $phone = trim($postData['phone'] ?? '');
        $email = trim($postData['email'] ?? '');
        $rating = $postData['rating'] ?? '';

        if ($business_id == "" || $name == "" || $phone == "" || $email == "" || $rating == "") {
            $response["message"] = "Required fields missing";
            return $response;
        }

        try {
            // check if email OR phone already exists for same business
            $check = $this->db->prepare("
                SELECT id FROM ratings
                WHERE business_id = :business_id
                AND (email = :email OR phone = :phone)
            ");

            $check->execute([
                ':business_id' => $business_id,
                ':email' => $email,
                ':phone' => $phone
            ]);

            $ratingData = $check->fetch(PDO::FETCH_ASSOC);

            if ($ratingData) {
                $stmt = $this->db->prepare("
                UPDATE ratings
                SET name = :name, rating = :rating
                WHERE id = :id");

                $stmt->execute([
                    ':name' => $name,
                    ':rating' => $rating,
                    ':id' => $ratingData['id']
                ]);
                return array("status" => true,"message" => "Rating updated successfully");
            } else {

                $stmt = $this->db->prepare("
                    INSERT INTO ratings (business_id, name, email, phone, rating)
                    VALUES (:business_id, :name, :email, :phone, :rating)
                ");

                $stmt->execute([
                    ':business_id' => $business_id,
                    ':name' => $name,
                    ':email' => $email,
                    ':phone' => $phone,
                    ':rating' => $rating
                ]);

                if ($stmt->rowCount() > 0) {
                    return array("status" => true,"message" => "Rating submitted successfully");
                }
            }
        } catch (PDOException $e) {
            return array("status" => false,"message" => "Database error");
        }

        return $response;
    }
}

?>