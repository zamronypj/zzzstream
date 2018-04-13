# zzzstream
PSR-7 StreamInterface implementation collection

# Requirement
- [PHP >= 5.3](https://php.net)
- [Composer](https://getcomposer.org)
- [PSR-7](http://www.php-fig.org/psr/psr-7/).

# Installation
Run through composer

    $ composer require juhara/zzzstream

# Available StreamInterface implementation

- `StringStream` string-based StreamInterface implementation.
- `ReadOnlyStringStream` read-only string-based StreamInterface implementation.
- `WriteOnlyStringStream` write-only string-based StreamInterface implementation.

# How to use

    <?php

    use Juhara\ZzzStream\StringStream;

    ...
    $stream = new StringStream('hellow world');

    //replace PSR-7 ResponseInterface instance with new body
    $newResponse = $response->withBody($stream);

# Contributing

If you have any improvement or issues please submit PR.

Thank you.
