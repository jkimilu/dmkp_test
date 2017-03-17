<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utilities
{
    /**
     * Creates a slug
     *
     * @param $string
     * @param string $slug_separator
     * @return mixed|string
     */
    public function get_slug($string, $slug_separator = "_")
    {
        $new_string = strtolower($string);
        $new_string = str_replace(" ", $slug_separator, $new_string);

        return $new_string;
    }
}