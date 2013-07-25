<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('clear'))
{
	function clear($content)
	{
		$karakter = array ('{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','-','/','\\',',','#',':',';','\'','"','[',']');
		$s = strtolower(str_replace($karakter,"",$content));
		return $s;
	}
}

// ------------------------------------------------------------------------

/* End of file clear_helper.php */
/* Location: ./system/heleprs/clear_helper.php */