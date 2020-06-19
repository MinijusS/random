<?php


namespace Core\Views;

use Core\View;

class Catalog extends View
{
    public function render(string $template_path = ROOT . '/core/templates/catalog.tpl.php')
    {
        return parent::render($template_path);
    }
}