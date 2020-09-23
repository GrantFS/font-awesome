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
    protected $frame_transform = '';
    protected $frame_class = '';

    public function __call(string $name, array $data = []) : string
    {
        $this->reset();
        $this->name = $this->camel2dashed($name);
        $this->checkFrame();
        $this->setData($data);

        $blade_template = snake_case($name);
        $default_icon = view()->exists('font_awesome::publish.' . $blade_template);
        $type = $default_icon ? '::publish.' : '.';

        if ($this->frame && view()->exists('font_awesome::' . $this->frame)) {
            return view('font_awesome::' . $this->frame)
            ->with('item', $this)
            ->render();
        } elseif ($this->frame && view()->exists('font_awesome.' . $this->frame)) {
            return view('font_awesome.' . $this->frame)
            ->with('item', $this)
            ->render();
        } elseif (!$default_icon && !view()->exists('font_awesome.' . $blade_template)) {
            return view('font_awesome::default')
            ->with('item', $this)
            ->render();
        }
        return view('font_awesome' . $type . $blade_template)
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

    public function hasTransform() : bool
    {
        return !empty($this->transform);
    }

    public function hasClass() : bool
    {
        return !empty($this->class);
    }

    public function getFrameTransform() : string
    {
        return $this->frame_transform;
    }

    public function hasFrameTransform() : bool
    {
        return !empty($this->frame_transform);
    }

    public function getFrameClass() : string
    {
        return $this->frame_class;
    }

    public function hasFrameClass() : bool
    {
        return !empty($this->frame_class);
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

    private function setData(array $data)
    {
        if (!empty($data[0])) {
            if (count($data[0]) == 1) {
                if (is_string($data[0])) {
                    $this->class = $data[0];
                } elseif (is_integer($data[0])) {
                    $this->count = $data[0];
                }
            } elseif (count($data[0]) > 1) {
                foreach ($data[0] as $key => $value) {
                    $key = snake_case($key);
                    $this->$key = $value;
                }
            }
        }
    }

    private function reset()
    {
        $this->frame = null;
        $this->name = '';
        $this->count = 0;
        $this->class = '';
        $this->text = '';
        $this->text_class = '';
        $this->transform = '';
        $this->frame_transform = '';
        $this->frame_class = '';
    }
}
