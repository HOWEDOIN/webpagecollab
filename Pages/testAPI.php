<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://covid-19-data.p.rapidapi.com/help/countries?format=json",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "x-rapidapi-host: covid-19-data.p.rapidapi.com",
        "x-rapidapi-key: 93640da901msh51758ec1344a0ebp15f840jsncf9045cfc3b3"
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}

//template for api to table

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
		<td>{$v['firstname']} {$v['firstname']} {$v['companyname']}</td>
		<td>{$v['email']}</td>
		<td>{$v['status']}</td>
	</tr>
HTML;
}

$table .= <<<HTML
</table>
HTML;

echo $table;