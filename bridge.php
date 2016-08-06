<?php

$query = $_POST['query'];
$query_parts = explode('.', $query);
$query = $query_parts[1];
$json_string = base64_decode($query);
$json = json_decode($json_string, 1);


$json['batch'][0]['response'] = array('compensation' => array());

$cards = $json['batch'][0]['response']['compensation'];

$cards = array();

for ($i=0; $i<8; $i++) {
    foreach (array(1,2,3,4,5, 6,7,8,9,10, 16,17,18,19,20) as $card_num) {
        $cards[] = array(
            'value' => "$card_num",
            'from' => "1000".sprintf('%011s', rand(0,10000000000)),
#            'from' => "100002502431024", # RichardWilkins
            'id'   => '0',
        );

    }
}

$json['batch'][0]['response']['compensation'] = $cards;
echo json_encode($json);

