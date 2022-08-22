<?php

$connect = new PDO("mysql:host=localhost;dbname=databasetoko", "root", "");
$received_data = json_decode(file_get_contents("php://input"));
$data = [];

//untuk fetch all data
if ($received_data->action == "fetchall") {
    $query = "SELECT
                *
            FROM
                phone
            ORDER BY 
                id DESC";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

//untuk insert data ke database
if ($received_data->action == "insert") {
    $data = [
        ":model" => $received_data->model,
        ":brand" => $received_data->brand,
        ":price" => $received_data->price,
    ];

    $query = "INSERT INTO 
                phone (model, brand, price) 
            VALUES (:model, :brand, :price)";
    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = [
        "message" => "Berhasil Simpan Data",
    ];

    echo json_encode($output);
}

//untuk ambil 1 data
if ($received_data->action == "fetchSingle") {
    $query = "SELECT 
                * 
            FROM 
                phone 
            WHERE 
                id = '".$received_data->id."'";

    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    foreach ($result as $row) {
        $data["id"] = $row["id"];
        $data["model"] = $row["model"];
        $data["brand"] = $row["brand"];
        $data["price"] = $row["price"];
    }

    echo json_encode($data);
}

//untuk update data
if ($received_data->action == "update") {
    $data = [
        ":model" => $received_data->model,
        ":brand" => $received_data->brand,
        ":price" => $received_data->price,
        ":id" => $received_data->hiddenId,
    ];

    $query = "UPDATE 
                phone 
            SET 
                model = :model,
                brand = :brand,
                price = :price
            WHERE
                id = :id";

    $statement = $connect->prepare($query);
    $statement->execute($data);
    $output = [
        "message" => "Data Berhasil Diupdate",
    ];

    echo json_encode($output);
}

//untuk hapus data
if ($received_data->action == "delete") {
    $query ="DELETE FROM 
                phone 
            WHERE
                id = '".$received_data->id."'";

    $statement = $connect->prepare($query);
    $statement->execute();
    $output = [
        "message" => "Data Terhapus",
    ];

    echo json_encode($output);
}

?>
