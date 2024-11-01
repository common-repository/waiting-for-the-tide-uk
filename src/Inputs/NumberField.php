<?php

namespace TidePlugin\Inputs;

/**
 * Class NumberField
 */
class NumberField extends InputField
{


    /**
     * NumberField constructor.
     * @param $id
     * @param $name
     * @param null|string|int $value
     * @param null|string $label
     * @param null|string $description
     * @param null|string $placeholder
     */
    public $min = 0;
    public $max = 0;

    public function __construct($id, $name, $classname, $range = [0,10], $value = null, $label = null, $description = null, $placeholder = null, $hide = false)
    {
        parent::__construct($id, $name, $classname, $value, $label, $description, $placeholder, $hide);
        $this->min = $range[0];
        $this->max = $range[1];
    }

    /**
     * Compiles the field.
     * @return string
     */
    public function compile()
    {
        return
            "<p {$this->hide_field()}>" .
            "<label for='{$this->id}' class='title_label'>{$this->label}</label>" .
            "<input type='number' min='{$this->min}' max='{$this->max}' id='{$this->id}' name='{$this->name}' class='widefat {$this->classname}' placeholder='{$this->placeholder}' value='$this->value'>" .
            "<span class='description'>{$this->description}</span>" .
            "</p>";
    }

    /**
     * Renders the field.
     */
    public function render()
    {
        echo $this->compile();
    }
}
