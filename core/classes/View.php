<?php

namespace Core;

class View
{
    protected $data;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     * Renders array of $this->data into template file
     * @param $template_path
     * @return false|string
     * @throws \Exception
     */
    public function render(string $template_path)
    {
        if (!file_exists($template_path)) {
            throw (new \Exception("Template with filename: {$template_path} does not exist!"));
        }

        $data = $this->data;

        ob_start();

        require $template_path;

        return ob_get_clean();
    }
}