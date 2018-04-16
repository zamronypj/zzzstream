<?php

namespace Juhara\ZzzStream;

/**
 * Decorator class that turn any PSR-7 StreamInterface into write only stream
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
final class WriteOnlyStream extends ReadWriteStream
{
    use WriteOnlyTrait;

    /**
     * get stream mode
     * 'rw' => read write, 'r' => read-only, 'w' => write-only
     * @return string mode
     */
    protected function mode()
    {
        return 'w';
    }
}
