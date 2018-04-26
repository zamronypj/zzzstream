# zzzstream
PSR-7 [StreamInterface][StreamInterface] implementation collection

# Requirement
- [PHP >= 5.3](https://php.net)
- [Composer](https://getcomposer.org)
- [PSR-7 StreamInterface][StreamInterface].

# Installation
Run through composer

    $ composer require juhara/zzzstream

# Available StreamInterface implementation

- `StringStream` string-based [StreamInterface][StreamInterface] implementation.
- `ReadOnlyStringStream` read-only string-based [StreamInterface][StreamInterface] implementation.
- `WriteOnlyStringStream` write-only string-based [StreamInterface][StreamInterface] implementation.
- `WrapperStream` decorator class that implements [StreamInterface][StreamInterface] which does nothing
except wraps other [StreamInterface][StreamInterface] instance.
- `ReadOnlyStream` decorator class that turn other [StreamInterface][StreamInterface] into read only stream.
- `WriteOnlyStream` decorator class that turn other [StreamInterface][StreamInterface] into write only stream.
- `FileStream` file-based [StreamInterface][StreamInterface] implementation.
- `TempStream` temporary stream [StreamInterface][StreamInterface] implementation.

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

# Unit Test

To run unit test, copy `phpunit.xml.dist` to `phpunit.xml` and run

    $ ./vendor/bin/phpunit

# Contributing

If you have any improvement or issues please submit PR.

Thank you.

[StreamInterface]:https://www.php-fig.org/psr/psr-7/#34-psrhttpmessagestreaminterface
