<?php

namespace Juhara\ZzzStream;

/**
 * Write-only string-based PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class WriteOnlyStringStream extends StringStream
{
    use WriteOnlyTrait;
}
