<?php 

function random_pokies_array() {
    include("connection.php");
    try {
       $results = $db->query(
         "SELECT name, img, number
         FROM pokies
         ORDER BY RAND()
         LIMIT 6"
       );
} catch (Exception $e) {
    echo "Unable to retrieve results";
    exit;
}
   return $results->fetchAll();
   
}

function get_item_html($item) {
    $output = "<li><a href='details.php?id="
        . $item["number"] . "'><img src='"
        . $item["img"] . "'>"
        . "<p>" . ucwords($item["name"])
        . "</p>";
    return $output;
}



function single_pokie_details($id) {
   include("connection.php");
   $results = $db->prepare(
      "SELECT *
      FROM pokies
      WHERE number = :id");
    $results->bindParam(":id",$_GET['id']);
    $results->execute();
    return $results->fetchAll()[0];
}