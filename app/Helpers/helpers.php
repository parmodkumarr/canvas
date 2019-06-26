<?php
//Use Request;
//use DateTime;
//have this file loaded in composer autoload->files

/**
 * check the url if is the current path or at a specified position in array
 * @param string $string
 */
if (!function_exists('checkActivePage')) {
	function checkActivePage($string, $position = false, $status = 'active')
	{

	    if ($position !== false)
	        return Request::segment($position) == $string ? $status : '';
	    else
	        return in_array($string, Request::segments()) ? $status : '';
	}
}

if (!function_exists('getChartSignalValue')) {
	function getChartSignalValue($signals, $level)
	{
		$return_value = '';
		foreach($signals as $signal){
			if($signal->level == $level){
				$return_value = $signal;
			}
		}
		return $return_value;
	}
}



