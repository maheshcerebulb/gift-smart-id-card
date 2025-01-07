<?php 

$curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://idcard.giftsez.com/check-cron-log',
        CURLOPT_RETURNTRANSFER => true,        
    ));
    $response = curl_exec($curl);
    echo "Yes";
?>