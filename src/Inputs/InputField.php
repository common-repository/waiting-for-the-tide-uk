<?php

namespace TidePlugin\Inputs;

/**
 * Class InputField
 */
abstract class InputField
{
    /** @var string $id */
    public $id;

    /** @var string $name */
    public $name;
    
    /** @var string $classname */
    public $classname; 

    /** @var null|string|int $value */
    public $value;

    /** @var null|string $label */
    public $label;

    /** @var null|string $description */
    public $description;

    /** @var null|string $placeholder */
    public $placeholder;

    public $hide;
    /**
     * InputField constructor.
     * @param $id
     * @param $name
     * @param null $value
     * @param null $label
     * @param null $description
     * @param null $placeholder
     */
    public function __construct($id, $name, $classname, $value = null, $label = null, $description = null, $placeholder = null, $hide = false)
    {
        $this->id = $id;
        $this->name = $name;
        $this->classname = $classname;
        $this->value = $value;
        $this->label = $label;
        $this->description = $description;
        $this->placeholder = $placeholder;
        $this->hide = $hide;
    }

    public function hide_field() {
        return $this->hide ? " style='display:none' " : ""; 
    }

    /**
     * @return string
     */
    public abstract function render();
}
