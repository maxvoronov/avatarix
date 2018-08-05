<?php

require_once __DIR__ . '/../vendor/autoload.php';

use MaxVoronov\Avatarix;
use MaxVoronov\Avatarix\SpriteCollection;

$avatarix = new Avatarix;
$avatarix->setPayload('username')
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/bg/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/faces/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/clothes/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/mouths/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/eyes/'))
    ->appendCollection(SpriteCollection::init(__DIR__ . '/assets/hairs/'));

$userAvatar = $avatarix->render();
// $userAvatar->save(__DIR__ . '/avatar.png');   // Save generated avatar into file
$userAvatar->show('png');                        // ... or output with image headers
