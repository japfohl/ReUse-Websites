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

    public static function logout() {

        //unset session variables
        $_SESSION = [];

        //unset cookie
        unset($_COOKIE[session_name()]);

        //destroy session
        session_destroy();
    }

    //redirect to a valid destination in the site
    public static function redirect($destination) {

        //http://php.net/manual/en/function.header.php
        $host = $_SERVER["HTTP_HOST"];
        $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
        header("Location: http://$host$path/$destination");

        // exit immediately since we're redirecting anyway
        exit;
    }

    public static function debug($msg) {
        file_put_contents("php://stdout", "\n$msg\n");
    }

    public static function buildMapJson($locs) {

        // create empty jsonArray
        $jsonArr = array();

        // loop over each thing in the array
        foreach ($locs as $loc) {

            // get the type and array lof locs
            $locType = $loc['type'];
            $locArr = $loc['locations'];

            // append an entry
            foreach ($locArr as $l) {
                $jsonArr[] = [
                    "lat" =>    Util::fetch_val('latitude', $l),
                    "long" =>   Util::fetch_val('longitude', $l),
                    "name" =>   Util::fetch_val('name', $l),
                    "add" =>    Util::fetch_val('address_line_1', $l),
                    "city" =>   Util::fetch_val('city', $l),
                    "state"  => Util::fetch_val('abbreviation', $l),
                    "zip" =>    Util::fetch_val('zip_code', $l),
                    "id" =>     Util::fetch_val('id', $l),
                    "type" =>   $locType
                ];
            }
        }

        // return properly
        return json_encode($jsonArr);
    }
}
