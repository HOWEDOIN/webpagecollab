<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Statistics of COVID=19!</title>
    <link rel="stylesheet" type="text/css" href="css%20stylesheet.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="Main.php" class="center">Home</a></li> | <li><a href="Details.php" class="center">Details about COVID-19</a></li> | <li><a href="Symptoms.php" class="center">Symptoms of COVID-19</a></li> | <li><a href="History.php" class="center">History of World-wide Epidemics</a></li> | <li><a href="Statistics.php" class="center"> Current Statistics of COVID-19 Cases Worldwide</a></li>
        </ul>
        <img src="Statistics.png" alt="Cover Photo">
        <hr/>
    </nav>
</header>
<h3>
    <strong>Live Statistics</strong> of <strong>Coronavirus</strong> by <strong>Country</strong>
</h3>
<p style="margin-left: 20%; margin-right: 20%; text-align-all: justify" ></p>
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
    $arr = explode('"', $response);
    $exlcuded_words = array(':', ',', '},', '{', ':{', ':[{', '},{', '}]}', ' currentItem is : ', ' totalCases', 'newCases', 'totalDeaths', 'totalRecovered', ' activeCases', 'criticalCases', 'totalCasesPerMillion', 'totalDeathsPerMillion', 'lastUpdated', 'countryWise', 'country', 'totalCases', 'activeCases', 'current');
    $arr1 = array();
    $arr2 = array();
    foreach ($arr as $item)
        array_push($arr1, $item);
    $finarray = array_diff($arr1, $exlcuded_words);
    foreach ($finarray as $i) {
        if (substr($i, -1) != "Z") {
            array_push($arr2, $i);
        }
    }
    array_unshift($arr2, "All countries");
    $arr3 = array();
    while (count($arr2) > 0) {
        $temp = array();
        for ($y = 0; $y <= 8; $y++) {
            array_push($temp, array_shift($arr2));
        }
        array_push($arr3, $temp);
        unset($temp);
    }

    $table1 = "";
    $table1 .= <<<HTML
   <table>
	<tr>
		<th>Country</th>
		<th>Total Cases</th>
		<th>New Cases</th>
		<th>Total Deaths</th>
		<th>Total Recovered</th>
		<th>Active Cases</th>
		<th>Critical Cases</th>
		<th>Total Cases per Million</th>
		<th>Total Deaths per Million</th>
	</tr>
HTML;
    echo $table1;
    foreach ($arr3 as $v) {
        $table2 = "";
        $table2 .= <<<HTML
<table2>
	<tr>
		<td>{$v[0]}</td>
		<td>{$v[1]}</td>
		<td>{$v[2]}</td>
		<td>{$v[3]}</td>
		<td>{$v[4]}</td>
		<td>{$v[5]}</td>
		<td>{$v[6]}</td>
		<td>{$v[7]}</td>
		<td>{$v[8]}</td>
	</tr>
</table2>

HTML;
        echo $table2;
    }
}
?>
<!--<hr/>-->
<!--<p>-->
<!--    <em>We believe that staying informed during a pandemic is a responsibility as global citizens. On this site, we hope-->
<!--        to inform you regarding the current known facts and figures about this worldwide pandemic.</em>-->
<!--</p>-->
<!--<p>-->
<!--    <em>This site is created and maintained by Ng Hao Yu (WIE180028,17093643/1) and Lee Hauii (WIE180020,17142346/1)</em>-->
<!--</p>-->
<!--<p>-->
<!--    You can check out some details about COVID-19 <a href="Details.php" style="color: seagreen"><u>here</u></a>.-->
<!--    <br>-->
<!--    We have listed known symptoms of COVID-19 patients <a href="Details.php" style="color: seagreen"><u>here</u></a>.-->
<!--    <br>-->
<!--    For history geeks, information regarding past epidemics <a href="Details.php"-->
<!--                                                               style="color: seagreen"><u>here</u></a>.-->
<!--    <br>-->
<!--    And finally, sourced world-wide statistics, updated in real-time, <a href="Details.php" style="color: seagreen"><u>here</u></a>.-->
<!--</p>-->
</body>
</html>