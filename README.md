# FontAwesome

FontAwesome is a Laravel Package currently designed to work with laravel 5.3+

## Installation

```

composer require loopy/font_awesome


```

Publish the assets

```

php artisan vendor:publish


```

In config/app.php

```
'providers' => [
    ...
    Loopy\FontAwesome\FontAwesomeServiceProvider::class
]

'aliases' => [
    ...
    'Icon' => Loopy\FontAwesome\Facades\FontAwesomeManagerFacade::class
]


```

Add Javascript

```

<script type="text/javascript" src="/vendor/loopy/font_awesome/js/fontawesome-all.min.js"></script>


```

## Standard Use


To use any of the Fontawesome icons that are free simiply use the facade followed by the name of the icon.
- Use camelcase
- Remember to escape

```

{!! Icon::addressBook() !!} => https://fontawesome.com/icons/address-book?style=regular


```

## Advanced Use

- Create the template in the views/fontawesome directory call it a snake case name
- Pass in a class to be used in the template this can be a string or an array

```

{!! Icon::list('text-primary') !!}
{!! Icon::list(['class' => 'text-primary', 'other_data' => 'Maybe a tooltip?' ]) !!}

```

## Frames

To use any Free Icon inside a frame, such as a circle or square.

Add Frame+Shape to the front of any Free Icon

```

Icon::FrameCircleAddressBook('text-primary)
Icon::FrameSquareUser('text-primary)


```
