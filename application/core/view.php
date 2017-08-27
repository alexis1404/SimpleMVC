<?php

class View
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    function generate($content_view, $template_view, $data = null)
    {

        if(is_array($data)) {
            extract($data);
        }

        if(file_exists('application/views/'.$template_view)) {
            include 'application/views/' . $template_view;
        }else if(file_exists('application/views/templates/'.$template_view)){
            include 'application/views/templates/'.$template_view;
        }
    }
}