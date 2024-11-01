<?php

namespace SikTec\SikTemplates;

use \SikTec\Exceptions;
use \SplFileInfo;

final class Template
{

    const TEMPLATE_EXT = ".tpl";

    /** @var SplFileInfo */
    private $source = null;

    private array $templates = [];

    private string $current = '';

    private string $template = '';

    private string $open_delimiter;

    private string $close_delimiter;

    private array $values = [];
  
    /**
     * __construct
     *
     * @param  string $source_path path to template folder or file
     * @param  string $openDelimiter
     * @param  string $closeDelimiter
     * @return void
     * @throws InvalidArgumentException
     */
    public function __construct($source_path = '', $open_delimiter = '{', $close_delimiter = '}')
    {

        if (file_exists($source_path)) {
            $this->source = new SplFileInfo($source_path); 
        } else {
            throw new Exceptions\InvalidArgumentException("Failed to load templates source '{$source_path}'");
        }

        //Folder or file:
        $this->load_available_templates();
        $this->open_delimiter  = $open_delimiter;
        $this->close_delimiter = $close_delimiter;
    
    }

    private function load_available_templates() {
        if ($this->source->isDir()) {
            $path = $this->source->getRealPath();
            $dir = scandir($path);
            foreach ($dir as $file) {
                if (str_ends_with($file, self::TEMPLATE_EXT)) {
                    $this->templates[$this->strip_extenssion($file)] = $path.DS.$file;
                }
            }
        } else {
            $template_name = $this->strip_extenssion($this->source->getFilename());
            $this->templates[$template_name] =  $this->source->getRealPath();
        }
    }

    private function strip_extenssion($file) {
        return str_replace(self::TEMPLATE_EXT, "", trim($file));
    }
    /**
     * load_template
     *
     * @param  string $name
     * @return bool
     */
    public function load_template($name)
    {
        $name = $this->strip_extenssion($name);
        if ($name === $this->current) {
            return true;
        }
        if (!array_key_exists($name, $this->templates)) {
            return false;
        }

        $this->template = file_get_contents($this->templates[$name]);

        return true;
    }


    public function set_arguments($args, $merge = true)
    {
        if (!$merge || empty($this->values)) {
            $this->values = $args;
            return;
        }
        $this->values = array_merge($this->values, $args);
    }

    public function render($name, $args = false, $merge = false)
    {
        if ($this->load_template($name)) {
            if ($args !== false) {
                $this->set_arguments($args, $merge);
            }
            $keys = [];
            foreach (array_keys($this->values) as $key) {
                $keys[] = $this->open_delimiter . $key . $this->close_delimiter;
            }
            return str_replace($keys, $this->values, $this->template);
        }
        return null;
    }

    public function render_to($target, $name, $args = false, $merge = false)
    {
        if (!file_put_contents($target, $this->render($name, $args, $merge) ?? "")) {
            throw new Exceptions\RuntimeException("Writing rendered result to '{$target}' failed");
        }
    }
}
