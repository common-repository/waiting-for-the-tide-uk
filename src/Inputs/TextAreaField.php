<?php

namespace TidePlugin\Inputs;

/**
 * Class TextAreaField
 */
class TextAreaField extends InputField
{

    public $columns = 25;
    public $rows    = 4;

    /**
     * TextAreaField constructor.
     * @param $id
     * @param $name
     * @param null|string|int $value
     * @param null|string $label
     * @param null|string $description
     * @param null|string $placeholder
     */
    public function __construct($id, $name, $classname, $dim = [5, 60], $value = null, $label = null, $description = null, $placeholder = null, $hide = false)
    {
        parent::__construct($id, $name, $classname, $value, $label, $description, $placeholder, $hide);
        $this->rows = $dim[0];
        $this->columns = $dim[1];
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
            "<textarea id='{$this->id}' name='{$this->name}' class='widefat code {$this->classname}' rows='{$this->rows}' cols='{$this->columns}' placeholder='{$this->placeholder}'>{$this->value}</textarea>" .
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
