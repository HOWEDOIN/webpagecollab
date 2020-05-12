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
            <li><a href="Main.php" style="text-align: center">Home</a></li> | <li><a href="Details.php" style="text-align: center">Details about COVID-19</a></li> | <li><a href="Symptoms.php" style="text-align: center">Symptoms of COVID-19</a></li> | <li><a href="History.php" style="text-align: center">History of World-wide Epidemics</a></li> | <li><a href="Statistics.php" style="text-align: center"> Current Statistics of COVID-19 Cases Worldwide</a></li>
        </ul>
        <img src="Statistics.png" alt="Cover Photo">
        <hr/>
    </nav>
</header>
<h3>
    Insert Title Here
</h3>
<p style="margin-left: 20%; margin-right: 20%; text-align-all: justify" </p>
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
    $table .= <<<HTML
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
		<th>Last Updated</th>
	</tr>
HTML;

    foreach ($response['clients']['client'] as $v)
    {
        $table .= <<<HTML
	<tr>
		<td>{$v['Country']}</td>
		<td>{$v['Total Cases']}</td>
		<td>{$v['New Cases']}</td>
		<td>{$v['Total Deaths']}</td>
		<td>{$v['Total Recovered']}</td>
		<td>{$v['Active Cases']}</td>
		<td>{$v['Critical Cases']}</td>
		<td>{$v['Total Cases per Million']}</td>
		<td>{$v['Total Deaths per Million']}</td>
		<td>{$v['Last Updated']}</td>
	</tr>
HTML;
        echo $table;
    }
}
?>
<hr/>
<p>
    <em>We believe that staying informed during a pandemic is a responsibility as global citizens. On this site, we hope
        to inform you regarding the current known facts and figures about this worldwide pandemic.</em>
</p>
<p>
    <em>This site is created and maintained by Ng Hao Yu (WIE180028,17093643/1) and Lee Hauii (WIE180020,17142346/1)</em>
</p>
<p>
    You can check out some details about COVID-19 <a href="Details.php" style="color: seagreen"><u>here</u></a>.
    <br>
    We have listed known symptoms of COVID-19 patients <a href="Details.php" style="color: seagreen"><u>here</u></a>.
    <br>
    For history geeks, information regarding past epidemics <a href="Details.php"
                                                               style="color: seagreen"><u>here</u></a>.
    <br>
    And finally, sourced world-wide statistics, updated in real-time, <a href="Details.php" style="color: seagreen"><u>here</u></a>.
</p>

</body>
</html>