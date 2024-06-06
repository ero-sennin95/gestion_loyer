<?php

namespace App;

class Functions{

//returns the string 'checked' if the $need exists in the array $haystack or an empty string otherwise.
public static function checked($needle, $haystack)
{
	if ($haystack) {
		return in_array($needle, $haystack) ? 'checked' : '';
	}

	return '';
}

}
