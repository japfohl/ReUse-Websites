<?php

/* TODO: Write good description of class
** The intent of this class is to have a place where all utility functions can be collected.
 */

class Util {

    public static function formatLinksWithHttp($link) {

	    $scheme = parse_url($link, PHP_URL_SCHEME);

	    if (empty($scheme)) {
			return 'http://' . ltrim($link, '/');
		} else {
			return $link;
		}
	}

    //replacing a single single-quote with two single-quotes in a given string
    public static function singleToDoubleQuotes(&$string) {

        $string = str_replace("'","''", $string);
    }

    //replacing a single underscore with a slash
    public static function underscoreToSlash(&$string) {

        $string = str_replace("_","/", $string);
    }

    // Helper used to safely fetch values from associative arrays
    public static function fetch_val($key, $array, $default = 'undefined') {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        } else {
            return $default;
        }
    }
}