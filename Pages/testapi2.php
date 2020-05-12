<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://covid-19-live-stats.p.rapidapi.com/livestats",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-rapidapi-host: covid-19-live-stats.p.rapidapi.com",
        "x-rapidapi-key: 93640da901msh51758ec1344a0ebp15f840jsncf9045cfc3b3"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $arr = explode('"',$response);
    foreach ($arr as $item)
        if (strlen($item)>2)
    echo "Item is : ".$item;
}