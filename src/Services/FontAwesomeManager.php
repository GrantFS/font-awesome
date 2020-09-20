<?php

namespace Loopy\FontAwesome\Services;

class FontAwesomeManager
{
    protected $frame;
    protected $name = '';
    protected $count = 0;
    protected $class = '';
    protected $text = '';
    protected $text_class = '';
    protected $transform = '';

    public function __call(string $name, array $data = []) : string
    {
        $this->name = $this->camel2dashed($name);
        $this->checkFrame();

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
        if ($this->frame) {
            return view('font_awesome::' . $this->frame)
            ->with('item', $this)
            ->render();
        }

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

    public function getFrame() : string
    {
        return $this->frame;
    }

    private function camel2dashed(string $className) : string
    {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $className));
    }

    private function checkFrame()
    {
        $box = explode('-', $this->name);
        if (!empty($box) && count($box) > 2 && $box[0] == 'frame') {
            $this->frame = $box[1];
            unset($box[1]);
            unset($box[0]);
            $this->name = implode('-', $box);
        }
    }
}
