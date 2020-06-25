<?php


namespace Core\Views;

use Core\View;

class Footer extends View
{
    public function render(string $template_path = ROOT . '/app/templates/nav.tpl.php')
    {
        return parent::render($template_path);
    }
}