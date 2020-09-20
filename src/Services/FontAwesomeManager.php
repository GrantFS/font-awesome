<?php

namespace Loopy\FontAwesome\Services;

class FontAwesomeManager
{
    protected $name = '';
    protected $count = 0;
    protected $class = '';
    protected $text = '';
    protected $text_class = '';
    protected $transform = '';

    public function __call(string $name, array $data = []) : string
    {
        $this->name = $this->camel2dashed($name);

        if (is_array($data) && isset($data[0])) {
            if (!is_string($data[0])&& !is_integer($data[0]) || count($data) > 1) {
                foreach ($data[0] as $key => $value) {
                    $key = snake_case($key);
                    $this->$key = $value;
                }
            } elseif (is_string($data[0])) {
                $this->class = $data[0];
            } elseif (is_integer($data[0])) {
                $this->count = $data[0];
            }
        }
        $default_icon = view()->exists('font_awesome::publish.' . snake_case($name));

        if (!$default_icon && !view()->exists('font_awesome.' . snake_case($name))) {
            return view('font_awesome::default')
            ->with('item', $this)
            ->render();
        }

        $type = $default_icon ? '::publish.' : '.';
        return view('font_awesome' . $type . snake_case($name))
        ->with('item', $this)
        ->render();
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getClass() : string
    {
        return $this->class;
    }

    public function getText() : string
    {
        return $this->text;
    }

    public function getTextClass() : string
    {
        return $this->text_class;
    }

    public function getTransform() : string
    {
        return $this->transform;
    }

    public function getCount() : int
    {
        return $this->count;
    }

    private function camel2dashed(string $className) : string
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
    }
}
