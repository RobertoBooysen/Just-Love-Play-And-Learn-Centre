<?php
global $conn;
require_once 'DBConn.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['grade'])) {
    //Get the selected grade from the GET request(Gosselin, Kokoska and Easterbrooks,2011)
    $selectedGrade = $_GET['grade'];

    //SQL query to retrieve child names and IDs based on the selected grade(Gosselin, Kokoska and Easterbrooks,2011)
    $query = "SELECT a.child_id, a.child_name, p.id
              FROM application a
              INNER JOIN parents p ON a.child_id = p.id
              WHERE a.status = 'APPROVED' AND a.grade = ?";

    //Prepare the SQL statement(Gosselin, Kokoska and Easterbrooks,2011)
    $stmt = $conn->prepare($query);

    //Bind the grade parameter to the SQL statement(Gosselin, Kokoska and Easterbrooks,2011)
    $stmt->bind_param("s", $selectedGrade);

    //Execute the SQL statement(Gosselin, Kokoska and Easterbrooks,2011)
    $stmt->execute();

    //Getting the result of the SQL query(Gosselin, Kokoska and Easterbrooks,2011)
    $result = $stmt->get_result();

    $childNamesAndIDs = [];

    //Looping through the query result and create an array with child names and IDs(Gosselin, Kokoska and Easterbrooks,2011)
    while ($row = $result->fetch_assoc()) {
        $childNamesAndIDs[] = [
            'c_name' => $row['child_name'] . ' (' . $row['id'] . ')',
            'c_id' => $row['child_id']
        ];
    }

    //Encode the array as JSON and echo it(Gosselin, Kokoska and Easterbrooks,2011)
    echo json_encode($childNamesAndIDs);
}
