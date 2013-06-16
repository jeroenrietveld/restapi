<?php

$ch = curl_init('http://restapi.dev/api/v1/products/1');

$data['id'] = 1;

curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
$results = json_decode(curl_exec($ch));

var_dump($results);