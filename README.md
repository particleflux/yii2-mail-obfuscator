yii2-mail-obfuscator
====================================================

A simple E-Mail obfuscating Widget using Javascript for Yii2.

Generates a mailto-Link only visible/usable when Javascript is activated.

Installation
------------

Installation via [composer][] by running:

	composer require particleflux/yii2-mail-obfuscator


Usage
-----

```php
<?php echo \particleflux\MailObfuscator\MailObfuscator::widget([
    'email' => 'example@particleflux.de',
    'text'  => 'send email',
    'options' => [
        'title' => 'mail me'
    ],
]); ?>
```


[composer]: https://getcomposer.org/ "The PHP package manager"