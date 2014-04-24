<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__)."/../../../libraries/Lex/Parser.php");

class Text_Parsing
{
    private $lex_parser;

    public function __construct()
    {
        $this->lex_parser = new Lex_Parser();
    }

    private function clean_text($text)
    {
        $new_text = $text;
        return $new_text;
    }

    private function parse_text($text)
    {
        $new_text = $text;
        return $new_text;
    }

    public function process_text($text)
    {
        $new_text = $text;
        $new_text = $this->clean_text($new_text);
        $new_text = $this->parse_text($new_text);
        return $new_text;
    }
}