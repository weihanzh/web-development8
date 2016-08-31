<?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST');
?>
<?php
$street = $_GET["street"];
$city = $_GET["city"];
$state = $_GET["state"];

$googleurl="https://maps.google.com/maps/api/geocode/xml?address=$street,$city,$state&key=AIzaSyDqKKcxxoX5p9EhdIVN9pf4H5Caq1YbQEs";

    //$googleurl="https://maps.googleapis.com/maps/api/geocode/xml?address=$_GET["street"],$_GET["city"].",".$_GET["state"]."&key=AIzaSyDqKKcxxoX5p9EhdIVN9pf4H5Caq1YbQEs";
    $locationxml=new SimpleXMLElement($googleurl, NULL, TRUE);
    $lati=$locationxml->result->geometry->location->lat;
    $longi=$locationxml->result->geometry->location->lng;
    $weatherurl="https://api.forecast.io/forecast/3834ca95084603452dfa2e4f71a23d43/".$lati.",".$longi."?units=".$_GET["degree"]."&exclude=flags";
    $contents=file_get_contents($weatherurl);
    $json=json_decode($contents);
    header("Content-Type: application/json", true);
    $weather1=json_encode($json);
    echo $weather1;
?>
    
