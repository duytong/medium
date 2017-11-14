<?php
function text_limit($str, $limit = 10) {
	$str_s = '';
	if (stripos($str, ' ')) {
		$ex_str = explode(' ', $str);
		if (count($ex_str) > $limit) {
			for ($i=0; $i < $limit; $i++) {
				$str_s .= $ex_str[$i] . ' ';
			}
			return $str_s;
		}
		return $str;
	}
	return $str;
}

function _substr($str, $length, $minword = 3) {
	$sub = '';
	$len = 0;
	foreach (explode(' ', $str) as $word) {
		$part = (($sub != '') ? ' ' : '') . $word;
		$sub .= $part;
		$len += strlen($part);
		if (strlen($word) > $minword && strlen($sub) >= $length) {
			break;
		}
	}
	return $sub . (($len < strlen($str)) ? '...' : '');
}
