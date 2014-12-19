<?php

if(isset($_GET['tx']))
{
  $tx = $_GET['tx'];
  // Further processing
  
  $response = do_post_request('https://www.sandbox.paypal.com/cgi-bin/webscr',http_build_query(array
    (
      'cmd' => '_notify-synch',
      'tx' => $tx,
      'at' => $your_pdt_identity_token,
    ))
	);
  	/*
  $request = curl_init();

// Set request options
curl_setopt_array($request, array
(
  CURLOPT_URL => 'https://www.sandbox.paypal.com/cgi-bin/webscr',
  CURLOPT_POST => TRUE,
  CURLOPT_POSTFIELDS => http_build_query(array
    (
      'cmd' => '_notify-synch',
      'tx' => $tx,
      'at' => $your_pdt_identity_token,
    )),
  CURLOPT_RETURNTRANSFER => TRUE,
  CURLOPT_HEADER => FALSE,
  // CURLOPT_SSL_VERIFYPEER => TRUE,
  // CURLOPT_CAINFO => 'cacert.pem',
));

// Execute request and get response and status code
$response = curl_exec($request);
$status   = curl_getinfo($request, CURLINFO_HTTP_CODE);

// Close connection
curl_close($request);	
  */
  
  $ppdata = check_and_clean_ppdata($response);
  
}

?>