<?php

namespace Loopy\FontAwesome\Facades;

use Illuminate\Support\Facades\Facade;

class FontAwesomeManagerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'font_awesome_manager';
    }
}
