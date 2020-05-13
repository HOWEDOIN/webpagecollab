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
    $exlcuded_words = array( ':',',','},','{',':{',':[{','},{','}]}',' currentItem is : ',' totalCases','newCases','totalDeaths','totalRecovered',' activeCases','criticalCases','totalCasesPerMillion','totalDeathsPerMillion','lastUpdated','countryWise','country','totalCases','activeCases','current');
    $arr1 = array();
    $arr2 = array();
    foreach ($arr as $item)
            array_push($arr1,$item);
    $finarray = array_diff($arr1,$exlcuded_words);
    foreach ($finarray as $i) {
        if (substr($i, -1) != "Z") {
            array_push($arr2, $i);
        }
    }
    array_unshift($arr2,"All countries");
    $arr3 = array();
    while(count($arr2)>0) {
        for ($y =0;$y <=8;$y++){
            $temp = array();
            array_push($temp,array_shift($arr2));
        }
        array_push($arr3,$temp);
    }
    }
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
	</tr>
HTML;
    foreach ($arr3 as $v)
    {
        $table .= <<<HTML
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
HTML;
        echo $table;
}