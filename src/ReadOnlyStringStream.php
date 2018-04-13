<?php

namespace Juhara\ZzzStream;

/**
 * Read-only string-based PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class ReadOnlyStringStream extends StringStream
{
    /**
    * Returns whether or not the stream is writable.
    *
    * @return bool
    */
    public function isWritable()
    {
        return false;
    }

    /**
    * Write data to the stream.
    *
    * @param string $string The string that is to be written.
    * @return int Returns the number of bytes written to the stream.
    * @throws \RuntimeException on failure.
    */
    public function write($string)
    {
        throw new \RuntimeException("Unsupported operation");
    }

}
