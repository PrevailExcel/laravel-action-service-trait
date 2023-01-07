# laravel-action-service-trait

[![Latest Stable Version](http://poser.pugx.org/prevailexcel/laravel-action-service-trait/v)](https://packagist.org/packages/prevailexcel/laravel-action-service-trait) 
[![License](http://poser.pugx.org/prevailexcel/laravel-action-service-trait/license)](https://packagist.org/packages/prevailexcel/laravel-action-service-trait)


> A Simple Package to create actions, traits and services using artisan commands in laravel.

This package extends the `make:` commands to help you easily create traits, action classes and service classes in Laravel 5+. It also comes with the option of creating an interface for the service.

# Install
```bash
composer require prevailexcel/laravel-action-service-trait
```

Or add the following line to the require block of your `composer.json` file.

```
"prevailexcel/laravel-action-service-trait": "1.0.*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once it is installed, you can use any of the commands in your terminal.

# Usage
```bash
php artisan make:action {name}
```
```bash
php artisan make:service {name}
```
```bash
php artisan make:service {name} --i
```
```bash
php artisan make:trait {name}
```

# Examples

## Create an action class
```bash
$ php artisan make:action CreateUser
```
`/app/Actions/CreateUser.php`
```php
<?php

namespace App\Actions;

/**
 * Class CreateUser
 * @package App\Services
 */
class CreateUser
{
    /**
     * @return true
     */
    public function execute(){
        // write your code here
        return true;
    }
}
```


## Create a service class with interface
```bash
php artisan make:service PostService --i
```
`/app/Services/PostService.php`
```php
<?php

namespace App\Services;

use App\Services\Interfaces\PostServiceInterface;

/**
 * Class PostService
 * @package App\Services
 */
 
class PostService implements PostServiceInterface
{

}
```
### Then the interface would look like this
`/app/Services/Interfaces/PostUserInterface.php`
```php
<?php

namespace App\Services\Interfaces;

/**
 * Interface PostServiceInterface
 * @package App\Services\Interfaces
 */
 
interface PostServiceInterface
{

}
```



## Create a php trait
`/app/Traits/UploadImage.php`
```bash
$ php artisan make:trait UploadImage
```

```php
<?php

namespace App\Traits;

/**
 * Trait UploadPhoto
 * @package App\Traits
 */

trait UploadPhoto
{

}
```


## Contributing

Please feel free to fork this package and contribute by submitting a pull request to enhance the functionalities.

## How can I thank you?

Why not star the github repo? I'd love the attention! Why not share the link for this repository on Twitter or HackerNews? Spread the word!

Don't forget to [follow me on twitter](https://twitter.com/EjimaduPrevail)!
Also check out my page on medium to catch articles and tutorials on Laravel [follow me on medium](https://medium.com/@prevailexcellent)!

Thanks!
Chimeremeze Prevail Ejimadu.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
