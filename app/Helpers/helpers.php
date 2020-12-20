<?php

function getPin($in_gimcana_patro, $in_app_patro, DateTime $in_date)
{
    $date_str = $in_date->format('Y-m-d'); //yyyy-mm-dd

	$val1 = intval(substr($date_str, 0, 1). substr($date_str, 9, 1));
	$val2 = intval(substr($date_str, 1, 1). substr($date_str, 8, 1));
	$val3 = intval(substr($date_str, 2, 1). substr($date_str, 6, 1));
	$val4 = intval(substr($date_str, 3, 1). substr($date_str, 5, 1));
	$checksum = intval(substr($in_app_patro, 12, 1));

	$index1 = ($val1 * $checksum) % 13;
	$index2 = ($val2 * $checksum) % 13;
	$index3 = ($val3 * $checksum) % 13;
	$index4 = ($val4 * $checksum) % 13;

	return substr($in_gimcana_patro, $index1, 1). substr($in_gimcana_patro, $index2, 1). substr($in_gimcana_patro, $index3, 1). substr($in_gimcana_patro, $index4, 1);
}
