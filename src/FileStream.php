<?php

namespace Juhara\ZzzStream;

/**
 * File stream PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class FileStream extends Stream
{
    public function __construct($filename, $mode)
    {
        parent::__construct(fopen($filename, $mode));
    }
}
