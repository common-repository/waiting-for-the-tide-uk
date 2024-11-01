<?php

namespace TidePlugin\Inputs;

/**
 * Class ToggleField
 */
class ToggleField extends InputField
{

    /**
     * ToggleField constructor.
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
        $checked = in_array($this->value, ['1', true, 1], true) ? "checked" : ""; 
        $pattern = "<p {$this->hide_field()}>
                        <input type='checkbox' class='wppd-ui-toggle {$this->classname}' id='{$this->id}' name='{$this->name}' value='1' {$checked} />
                        <label for='{$this->id}'>{$this->label}</label>
                        <span class='description' style='vertical-align: middle'>{$this->description}</span>
                    </p>";
        return $pattern;
    }

    /**
     * Renders the field.
     */
    public function render()
    {
        echo $this->compile();
    }
}
