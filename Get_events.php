<?php
global $conn;
require_once 'DBConn.php';

//Function to fetch events from the database(Gosselin, Kokoska and Easterbrooks,2011)
function getEventsFromDatabase($conn) {
    $events = array();

    $sql = "SELECT event_name, event_description, event_date, events_file FROM events";
    $result = $conn->query($sql);

    //Check if there are rows in the result set(Gosselin, Kokoska and Easterbrooks,2011)
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //Format the date to match FullCalendar's requirements(Gosselin, Kokoska and Easterbrooks,2011)
            $formattedDate = date('Y-m-d', strtotime($row['event_date']));

            //Create an event array and add it to the events array(Gosselin, Kokoska and Easterbrooks,2011)
            $events[] = array(
                'title' => $row['event_name'], // Event name(Gosselin, Kokoska and Easterbrooks,2011)
                'event_description' => $row['event_description'], // Event description(Gosselin, Kokoska and Easterbrooks,2011)
                'start' => $formattedDate, // Event start date(Gosselin, Kokoska and Easterbrooks,2011)
                'events_file' => $row['events_file'], // Event file(Gosselin, Kokoska and Easterbrooks,2011)
            );
        }
    }

    return $events;
}

//Create a connection to your database (e.g., using DBConn.php)(Gosselin, Kokoska and Easterbrooks,2011)
global $conn;
require_once 'DBConn.php';

//Fetch events from the database(Gosselin, Kokoska and Easterbrooks,2011)
$events = getEventsFromDatabase($conn);

//Return events as JSON data(Gosselin, Kokoska and Easterbrooks,2011)
header('Content-Type: application/json');
echo json_encode($events);
?>
