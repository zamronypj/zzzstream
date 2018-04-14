<?php

namespace Juhara\ZzzStream;

/**
 * Decorator class that turn any PSR-7 StreamInterface into write only stream
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class WriteOnlyStream extends WrapperStream
{
    use WriteOnlyTrait;
}
