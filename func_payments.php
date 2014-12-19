<?php
// move to misc?
function ipn_to_utf8($ipn_data){
	if(array_key_exists('charset', $ipn_data) && ($charset = $ipn_data['charset']))
	{
	    // Ignore if same as our default
	    if($charset == 'utf-8')
	        return;
	
	    // Otherwise convert all the values
	    foreach($ipn_data as $key => &$value)
	    {
	        $value = mb_convert_encoding($value, 'utf-8', $charset);
	    }
	
	    // And store the charset values for future reference
	    $ipn_data['charset'] = 'utf-8';
	    $ipn_data['charset_original'] = $charset;
		
		return $ipn_data;
	}
	}

function check_and_clean_ppdata($response){
		
		if($status == 200 AND strpos($response, 'SUCCESS') === 0)
	{
		
		// Remove SUCCESS part (7 characters long)
	$response = substr($response, 7);
	
	// URL decode
	$response = urldecode($response);
	
	// Turn into associative array
	preg_match_all('/^([^=\s]++)=(.*+)/m', $response, $m, PREG_PATTERN_ORDER);
	$response = array_combine($m[1], $m[2]);
	
	// Fix character encoding if different from UTF-8 (in my case)
	if(isset($response['charset']) AND strtoupper($response['charset']) !== 'UTF-8')
	{
	  foreach($response as $key => &$value)
	  {
	    $value = mb_convert_encoding($value, 'UTF-8', $response['charset']);
	  }
	  $response['charset_original'] = $response['charset'];
	  $response['charset'] = 'UTF-8';
	}
	
	// Sort on keys for readability (handy when debugging)
	ksort($response);	
	    // Further processing
	}
	else
	{
	    // Log the error, ignore it, whatever 
	}	
	}

function do_post_request($url, $data, $optional_headers = null)
{
  $params = array('http' => array(
              'method' => 'POST',
              'content' => $data
            ));
  if ($optional_headers !== null) {
    $params['http']['header'] = $optional_headers;
  }
  $ctx = stream_context_create($params);
  $fp = @fopen($url, 'rb', false, $ctx);
  if (!$fp) {
    throw new Exception("Problem with $url, $php_errormsg");
  }
  $response = @stream_get_contents($fp);
  if ($response === false) {
    throw new Exception("Problem reading data from $url, $php_errormsg");
  }
  return $response;
}
?>