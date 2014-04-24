<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lex_Callbacks
{
    public static function callback($name, $attributes, $content)
    {
        // Process
        $processed_content = $content;
        $function_name = str_replace(":", "_", $name);
        $processed_content = self::$function_name($attributes, $processed_content);

        return $processed_content;
    }

    private static function popup_open($attributes, $content)
    {
        // Load the relevant models
        $ci = &get_instance();
        $ci->load->model('ems/content_popups_model');

        $new_content = $content;
        $popup_row = $ci->content_popups_model->find_by(array('slug' => $attributes['popup']));

        if($popup_row)
        {
            $content_html = htmlentities($popup_row->popup_content);
            $new_content = "<a href='javascript:void();' data-toggle='popover' data-content='{$content_html}'>{$new_content}</a>";
        }

        return $new_content;
    }
}
