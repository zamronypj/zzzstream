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
- `WrapperStream` decorator class that implements StreamInterface which does nothing
except wraps other StreamInterface instance.
- `ReadOnlyStream` decorator class that turn other StreamInterface into read only stream.
- `WriteOnlyStream` decorator class that turn other StreamInterface into write only stream.

# How to use

### Create stream instance from string

    <?php

    use Juhara\ZzzStream\StringStream;

    ...
    $stream = new StringStream('hello world');

    //replace PSR-7 ResponseInterface instance with new body
    $newResponse = $response->withBody($stream);

### Create read-only string stream instance

    <?php

    use Juhara\ZzzStream\ReadOnlyStringStream;

    ...
    $stream = new ReadOnlyStringStream('hello world');

    //replace PSR-7 ResponseInterface instance with new body
    $newResponse = $response->withBody($stream);

### Force string stream instance to become read-only

    <?php

    use Juhara\ZzzStream\StringStream;
    use Juhara\ZzzStream\ReadOnlyStream;

    ...
    $stream = new ReadOnlyStream(new StringStream('hello world'));

    //replace PSR-7 ResponseInterface instance with new body
    $newResponse = $response->withBody($stream);

# Contributing

If you have any improvement or issues please submit PR.

Thank you.
