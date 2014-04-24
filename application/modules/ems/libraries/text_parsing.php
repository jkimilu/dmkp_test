<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/../../../libraries/Lex/Parser.php");
require_once(dirname(__FILE__)."/Lex_Callbacks.php");

class Text_Parsing
{
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

    public function process_text($text)
    {
        $new_text = $text;

        // Clean for the Lex Parser
        $new_text = $this->clean_text($new_text);
        // Parse
        $new_text = $this->parse_text($new_text);
        // Back to HTML
        $new_text = htmlentities($new_text);

        return $new_text;
    }
}