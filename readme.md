# Laravel Instagram

## Introduction

To get started with Instagram, add to your `composer.json` file as a dependency:

    composer require mayoz/instagram

### Configuration

After installing the Instagram library, register the `Mayoz\Instagram\InstagramServiceProvider` in your `config/app.php` configuration file:

    'providers' => [
        // Other service providers...

        Mayoz\Instagram\InstagramServiceProvider::class,
    ],

Also, add the `Instagram` facade to the `aliases` array in your `app` configuration file:

    'Instagram' => Mayoz\Instagram\Facades\Instagram::class,

You will also need to add credentials for the OAuth services your application utilizes. These credentials should be placed in your `config/services.php` configuration file with `instagram` key. For example:

    'instagram' => [
        'client_id'     => env('INSTAGRAM_KEY'),
        'client_secret' => env('INSTAGRAM_SECRET'),
        'redirect'      => env('INSTAGRAM_REDIRECT_URI'),
    ],

### Basic Usage

Next, you are ready to use. Please see the following examples.

    <?php

    namespace App\Http\Controllers;

    use Instagram;
    use Illuminate\Routing\Controller;

    class HomeController extends Controller
    {
        /**
         * Get the most popular Instagram medias.
         *
         * @return Response
         */
        public function getPopularMedia()
        {
            return Instagram::getPopularMedia();
        }
    }

```

## Documentation
This package is only bridge for Laravel5. Please check the [Instagram PHP-API](https://github.com/cosenary/Instagram-PHP-API) documents for more details.

## License

THis package is licensed under [The MIT License (MIT)](LICENSE).
