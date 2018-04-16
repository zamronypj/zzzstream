<?php

namespace Juhara\ZzzStream;

/**
 * Decorator class that turn any PSR-7 StreamInterface into read only stream
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class ReadOnlyStream extends ReadWriteStream
{
    use ReadOnlyTrait;

    /**
     * get stream mode
     * 'rw' => read write, 'r' => read-only, 'w' => write-only
     * @return string mode
     */
    protected function mode()
    {
        return 'r';
    }
}
