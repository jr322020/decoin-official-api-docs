<?php
$host = "https://apiv1.decoin.io/";
$path = "Wallet/withdraw-funds";
$params = array('Currency' => 'Bitcoin','Address'=>'WALLET_ADDRESS','Label'=>'abcd','Amount'=>'1');
$headers = array('KEY-X'=> '12345');
$Time = time();
$ExpTime = time() + 50000;
$url = $host.$path;
$key = '12345';
$secret = '12345';
$method = "POST";
$bodytohash =  array('Address'=>'WALLET_ADDRESS','Amount'=>'1','Currency' => 'Bitcoin');
$body = json_encode((array)$bodytohash);
$string = $key.$url.$method.$body.$Time.$ExpTime;
//generate signature
$sig = hash_hmac('sha256', $string, $secret);

$ch = curl_init();

// endpoint url
curl_setopt($ch, CURLOPT_URL, $host . $path);

// set request as regular post
curl_setopt($ch, CURLOPT_POST, true);

// set data to be send
 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));

// set header
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('KEY-X:'.$key,'SIG-X:'.$sig,'TIME-X:'.$Time,'EXP-X:'.$ExpTime));

// return transfer as string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
echo $response;
curl_close($ch)
?>
