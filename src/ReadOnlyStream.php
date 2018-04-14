<?php

namespace Juhara\ZzzStream;

/**
 * Decorator class that turn any PSR-7 StreamInterface into read only stream
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class ReadOnlyStream extends WrapperStream
{
    use ReadOnlyTrait;
}
