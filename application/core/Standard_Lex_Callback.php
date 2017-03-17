<?php

/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 6/21/16
 * Time: 11:01 AM
 */
class Standard_Lex_Callback
{
    protected static $content_popups_model;
    protected $ci;
    
    public function __construct() {
        $this->ci = &get_instance();
    }

    public static function callback($name, $attributes, $content) {
        // Process
        $processed_content = $content;
        $function_name = str_replace(":", "_", $name);
        $processed_content = self::$function_name($attributes, $processed_content);

        return $processed_content;
    }

    protected static function popup_open($attributes, $content) {
        $new_content = $content;
        $popup_row = self::$content_popups_model->find_by(array('slug' => $attributes['popup'], 'deleted' => 0));

        if($popup_row)
        {
            $content_html = htmlentities($popup_row->popup_content);
            $new_content = "<a href='javascript:void();' data-toggle='popover' data-content='{$content_html}'>{$new_content}</a>";
        }

        return $new_content;
    }
}