<?php

namespace Juhara\ZzzStream;


/**
 * Temporary stream PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class TempStream extends FileStream
{
    public function __construct()
    {
        parent::__construct(fopen('php://temp', 'rw'));
    }
}
