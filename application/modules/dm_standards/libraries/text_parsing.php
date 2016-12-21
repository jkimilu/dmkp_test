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
}