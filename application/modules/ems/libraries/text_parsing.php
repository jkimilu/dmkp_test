<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/simple_html_dom.php");

require_once(dirname(__FILE__)."/../../../libraries/Lex/Parser.php");
require_once(dirname(__FILE__)."/Lex_Callbacks.php");

class Text_Parsing
{
    const segment_type_paragraph = "p";

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
}