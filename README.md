# Avatarix

## Install
The preferred way to install this extension is through [composer](http://getcomposer.org/download/):
```
composer require maxvoronov/avatarix
```

## Usage
Library can generate 8-bits avatar by any string. This package use [Imagine](http://imagine.readthedocs.io/) for processing.

```php
use MaxVoronov\Avatarix;
use MaxVoronov\Avatarix\SpriteCollection;

$avatarix = new Avatarix;
$avatarix->setPayload('username');       // You can use here user ID or email

$avatarix                                // Set collections of avatar parts
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/bg/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/faces/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/clothes/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/mouths/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/eyes/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/hairs/'));

$userAvatar = $avatarix->render();
$userAvatar->save('/path/to/avatar.png');       // Save generated avatar into file
$userAvatar->show('png');                       // ... and output with image headers
```

You can also look at [an example](examples).

## Special Thanks
Special thanks to @matveyco and his [8biticon Project](https://github.com/matveyco/8biticon/) for avatar sprites.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.