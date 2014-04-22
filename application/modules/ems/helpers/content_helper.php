<?php

function load_content_editors($content_variables)
{
    $language = lang("ems_tree");
    // Main content
    $main_content_variable = $content_variables["content"];
    echo("<div class='row'>");
    echo("<p>".$language['main_content']."</p>");
    echo("<textarea class='ckeditor' name='content'>{$main_content_variable}</textarea>");
    echo("</div>");

    // Content blocks
    foreach($content_variables["chunks"] as $content_item_key => $content_item_value)
    {
        echo("<div class='row'>");
        echo("<p>".$language[$content_item_key]."</p>");
        echo("<textarea class='ckeditor' name='{$content_item_key}'>{$content_item_value}</textarea>");
        echo("</div>");
    }
}