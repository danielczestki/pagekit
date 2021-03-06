<?php

namespace Pagekit\Widget\Model;

use Pagekit\Module\Module;

class Type extends Module implements TypeInterface
{
    /**
     * {@inheritdoc}
     */
    public function render(WidgetInterface $widget, $options = [])
    {
        if (is_callable($this->render)) {
            return call_user_func($this->render, $widget, $options);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return ['name' => $this->name];
    }
}
