<?php
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://sms.vnet.vn:8082/api/sent?username=[condovn]&password=[co$D0vn]&source_addr=[841663578000]&dest_addr=[841679263615]&message=[Test]',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
echo curl_getinfo($curl) . '<br/>';
echo curl_errno($curl) . '<br/>';
echo curl_error($curl) . '<br/>';
// Close request to clear up some resources

curl_close($curl);