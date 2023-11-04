
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");
include 'include.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data)) {
    $requiredFields = ['E_name', 'E_date', 'Category', 'Location', 'Num_of_sites', 'Description', 'Img'];
    $allFieldsPresent = true;

    foreach ($requiredFields as $field) {
        if (!isset($data[$field]) || empty($data[$field])) {
            $allFieldsPresent = false;
            break;
        }
    }

    if ($allFieldsPresent) {
        $sql = "INSERT INTO events (E_name, E_date, Category, Location, Num_of_sites, Description, Img) VALUES (
            '{$data['E_name']}',
            '{$data['E_date']}',
            '{$data['Category']}',
            '{$data['Location']}',
            '{$data['Num_of_sites']}',
            '{$data['Description']}',
            '{$data['Img']}'
        )";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(array("message" => "Event record created successfully."));
        } else {
            echo json_encode(array("error" => "Error: " . $conn->error));
        }
    } else {
        echo json_encode(array("error" => "Please provide all required fields."));
    }
} else {
    echo json_encode(array("error" => "No data received."));
}

$conn->close();
?>