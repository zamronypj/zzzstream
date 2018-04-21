<?php

namespace Juhara\ZzzStream;

/**
 * Temporary stream PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class TempStream extends Stream
{
    /**
     * constructor that create stream from temporary file
     *
     * @link http://www.php.net/manual/en/function.fopen.php
     * @param string $mode file mode
     */
    public function __construct($mode = 'w+')
    {
        parent::__construct(fopen('php://temp', $mode));
    }
}
