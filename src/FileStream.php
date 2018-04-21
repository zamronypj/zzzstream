<?php

namespace Juhara\ZzzStream;

/**
 * File stream PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class FileStream extends Stream
{
    /**
     * constructor that initialize instance with filename and mode to open
     * file
     * @link http://www.php.net/manual/en/function.fopen.php
     * @param string $filename filename
     * @param string $mode     file mode
     */
    public function __construct($filename, $mode)
    {
        parent::__construct(fopen($filename, $mode));
    }
}
