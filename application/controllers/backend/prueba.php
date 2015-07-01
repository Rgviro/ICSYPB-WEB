<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Give Me Post Params
 *
 * Check if params are JSON encoded (acording to content-type header) and if so decode and return
 * if not simply return the POST array so 
 *
 * @access public
 * @return array
 */
if ( ! function_exists('give_me_post_params'))
{  
  function give_me_post_params()
  {
    $result = $_POST;
    // Check if Content Type is JSON
    if( isset( $_SERVER['CONTENT_TYPE'] ) &&
        strpos( $_SERVER['CONTENT_TYPE'], "application/json" ) !== false )
    {      
      $jsonData = json_decode( trim( file_get_contents( 'php://input' ) ), true );  
      $result = $jsonData;
    }
    return $result;
  }
}