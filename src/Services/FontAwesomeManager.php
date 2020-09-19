<?php

namespace Loopy\FontAwesome\Services;

class FontAwesomeManager
{
    public $name = '';
    public $count = 0;
    public $class = '';
    public $text = '';
    public $text_class = '';
    public $transform = '';
    public $hours = '';

    public function __call(string $name, array $data = []) : string
    {
        $name = $this->camel2dashed($name);

        if (is_array($data) && isset($data[0]) && !is_string($data[0])&& !is_integer($data[0])) {
            foreach ($data[0] as $key => $value) {
                $key = snake_case($key);
                $this->$key = $value;
            }
        } elseif (is_array($data) && isset($data[0]) && is_string($data[0])) {
            $this->class = $data[0];
        } elseif (is_array($data) && isset($data[0]) && is_integer($data[0])) {
            $this->count = $data[0];
        }
        $default_icon = view()->exists('font_awesome::' . snake_case($name));

        if (!$default_icon && !view()->exists('fontawesome.' . snake_case($name))) {
            return view('font_awesome::default')
            ->with('item', $this)
            ->render();
        }
        $type = $default_icon ? '::' : '.';
        return view('font_awesome' . $type . snake_case($name))
        ->with('item', $this)
        ->render();
    }

    private function camel2dashed(string $className) : string
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
    }
}
