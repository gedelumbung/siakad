<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('beban_studi'))
{
	function beban_studi($ipk)
	{
		if($ipk < 2){
			return 15;
			}
		else if(($ipk >= 2) && ($ipk <= 2.50)){
			return 18;
			}
		else if(($ipk >= 2.51) && ($ipk <= 2.74)){
			return 20;
			}
		else if(($ipk >= 2.75) && ($ipk <= 2.99)){
			return 22;
			}
		else if($ipk >= 3) {
			return 24;
		}
	}
}
