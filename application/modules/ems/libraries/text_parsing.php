<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/simple_html_dom.php");

require_once(dirname(__FILE__)."/../../../libraries/Lex/Parser.php");
require_once(dirname(__FILE__)."/Lex_Callbacks.php");

class Text_Parsing
{
    const segment_type_paragraph = "p";

    const view_state_visible = 1;
    const view_state_hidden = 2;
    const view_state_do_not_show = 3;

    const style_1 = "visible";
    const style_2 = "hidden";

    const display_style_1 = "block";
    const display_style_2 = "none";

    private $lex_parser;

    public function __construct()
    {
        $this->lex_parser = new Lex_Parser();
        $this->lex_parser->scopeGlue(":");
    }

    private function clean_text($text)
    {
        $new_text = $text;
        $new_text = str_replace("&#39;", "'", $new_text);
        return $new_text;
    }

    private function lex_data()
    {
        return array();
    }

    private function parse_text($text)
    {
        $new_text = $text;
        $new_text = $this->lex_parser->parse($new_text, $this->lex_data(), "Lex_Callbacks::callback");
        return $new_text;
    }

    /**
     * Process text for output
     *
     * @param $text
     * @return mixed|string
     */

    public function process_text($text)
    {
        $new_text = $text;

        // Clean for the Lex Parser
        $new_text = $this->clean_text($new_text);
        // Parse
        $new_text = $this->parse_text($new_text);

        return $new_text;
    }

    /**
     * Embeds other additional elements
     *
     * @param $array
     * @param $html_segments
     */

    private function global_text_segments(&$array, $html_segments)
    {
        foreach($html_segments->find('table') as $html_element)
        {
            $array[] = "<table class='".(isset($html_element->class) ? $html_element->class : "")."'>" . $html_element->innertext . "</table>";
        }
    }

    /**
     * Get segments in text
     *
     * @param $text
     * @param string $type
     * @return array
     */

    public function get_text_segments($text, $type = self::segment_type_paragraph)
    {
        $html_segments = str_get_html($text);
        $return_array = array();

        if($html_segments)
        {
            switch($type)
            {
                case self::segment_type_paragraph:

                    // Add paragraphs
                    foreach($html_segments->find('p') as $html_element)
                        $return_array[] = $html_element->innertext;

                    // Add global segments: if needed
                    // $this->global_text_segments($return_array, $html_segments);

                    break;
            }
        }

        // Clean up
        $array_index = 0;

        foreach($return_array as $array_item)
        {
            if(trim($array_item) == "")
            {
                array_splice($return_array, $array_index, 1);
            }
            else
            {
                $array_index ++;
            }
        }

        // Return
        return $return_array;
    }

    /**
     * Get view mode
     *
     * @return array
     */

    public function get_role_view_modes()
    {
        return array(1 => "view", 2 => "hide", 3 => "do_not_show");
    }

    /**
     * Return a role specific view
     *
     * @param $content
     * @param $role_view_settings
     * @return string
     */
    public function process_content_for_role($content, $role_view_settings)
    {
        // Settings exist, Break up the content
        if($role_view_settings)
        {
            $processed_content = $this->get_text_segments($content, self::segment_type_paragraph);

            $current_view_state = self::view_state_visible;
            $current_style = "style_{$current_view_state}";

            $processed_block_count = 0;

            $text_block = "<div id='c_bl_{$processed_block_count}' style='visibility:".constant("Text_Parsing::{$current_style}")."; display:".constant("Text_Parsing::display_{$current_style}")."'>";

            $current_block_index = 0;

            foreach($role_view_settings as $role_view_setting)
            {
                if($role_view_setting->permission != self::view_state_do_not_show)
                {
                    if("style_{$role_view_setting->permission}" != $current_style)
                    {
                        $processed_block_count ++;

                        $current_style = "style_{$role_view_setting->permission}";

                        $text_block.="</div>";

                        if($role_view_setting->permission == self::view_state_hidden)
                        {
                            $text_block.='<a id="c_bn_'.$processed_block_count.'" href="javascript:display_content_block('."'{$processed_block_count}'".');" class="btn btn-small read_more"><i class="fa fa-eye"></i> Read More...</a>';
                        }

                        $text_block.="<div id='c_bl_{$processed_block_count}' style='visibility:".constant("Text_Parsing::{$current_style}")."; display:".constant("Text_Parsing::display_{$current_style}")."'>";
                    }

                    if(isset($processed_content[$current_block_index]))
                        $text_block.="<p>".$processed_content[$current_block_index]."</p>";
                }

                $current_block_index ++;
            }

            $text_block .= "</div>";

            return $text_block;
        }

        // No settings, just send back original content
        return $content;
    }
}