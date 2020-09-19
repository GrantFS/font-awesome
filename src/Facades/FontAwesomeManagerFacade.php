<?php

namespace Loopy\FontAwesome\Facade;

use Illuminate\Support\Facades\Facade;

class FontAwesomeManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'font_awesome_manager';
    }
}
