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

## Use


