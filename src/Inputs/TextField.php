<?php

namespace TidePlugin\Inputs;

/**
 * Class TextField
 */
class TextField extends InputField
{

    /**
     * TextField constructor.
     * @param $id
     * @param $name
     * @param null|string|int $value
     * @param null|string $label
     * @param null|string $description
     * @param null|string $placeholder
     */
    public function __construct($id, $name, $classname, $value = null, $label = null, $description = null, $placeholder = null, $hide = false)
    {
        parent::__construct($id, $name, $classname, $value, $label, $description, $placeholder, $hide);
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
            "<input type='text' id='{$this->id}' name='{$this->name}' class='widefat {$this->classname}' placeholder='{$this->placeholder}' value='$this->value'>" .
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
