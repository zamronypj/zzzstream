<?php

namespace Juhara\ZzzStream;

use RuntimeException;

/**
 * Read-only string-based PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class ReadOnlyStringStream extends StringStream
{
    use ReadOnlyTrait;
}
