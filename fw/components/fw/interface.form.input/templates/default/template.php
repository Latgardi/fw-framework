<div<?php
if (isset($this->params['additional_class'])) echo " class=\"{$this->params['additional_class']}\"";
$name = $this->params['name'] ?? '';
$id = $this->params['id'] ?? $this->generateID($name);
$title = $this->params['title'] ?? '';
$label = "<label class=\"form-label\" for=\"{$id}\">{$title}</label>\n"
?>>
    <?php
    if (isset($this->params['type'])) {
        $type = $this->params['type'];
        if ($type !== 'checkbox' && $type !== 'radio') {
            echo $label;
        }
        if ($type === 'select') {
            echo "<select";
        } else if ($type === 'textarea'){
            echo "<textarea";
        } else {
            echo "<input";
        }
        echo " type=\"{$type}\"";
    }
    if (!empty($name)) {
        echo " name=\"{$name}\"";
    }
    if (isset($this->params['attr'])) {
        foreach ($this->params['attr'] as $attr => $value) {
            echo " {$attr}=\"{$value}\"";
        }
    }
    if (isset($this->params['default']) && $type !== 'textarea') {
        echo " value=\"{$this->params['default']}\"";
    }
    echo " id=\"{$id}\"";
    echo "/";
    ?>>
    <?php
    if ($type === "select") {
        if (isset($this->params['list'])) {
            foreach ($this->params['list'] as $option) {
                echo "<option";
                if (isset($option['value'])) {
                    echo " value=\"{$option['value']}\"";
                }
                if (isset($option['additional_class'])) {
                    echo " class=\"{$option['additional_class']}";
                }
                if (isset($option['attr'])) {
                    foreach ($option['attr'] as $attr => $value) {
                        echo " {$attr}=\"{$value}\"";
                    }
                }
                if (!empty($option['multiple'])) {
                    echo " multiple";
                }
                if (!empty($option['selected'])) {
                    echo " selected";
                }
                echo ">";
                if (isset($option['title'])) {
                    echo $option['title'];
                }
                echo "</option>";
            }
        }
        echo "</select>";
    } else if ($type === 'textarea') {
        if (isset($this->params['default'])) {
            echo $this->params['default'];
        }
        echo "</textarea>";
    }
    if ($type === 'checkbox' || $type === 'radio') {
        echo $label;
    }?>
</div>
