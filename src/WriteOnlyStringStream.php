<?php

namespace Juhara\ZzzStream;

/**
 * Write-only string-based PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class WriteOnlyStringStream extends StringStream
{
    /**
    * Returns whether or not the stream is readable.
    *
    * @return bool
    */
    public function isReadable()
    {
        return true;
    }

    /**
    * Read data from the stream.
    *
    * @param int $length Read up to $length bytes from the object and return
    *     them. Fewer than $length bytes may be returned if underlying stream
    *     call returns fewer bytes.
    * @return string Returns the data read from the stream, or an empty string
    *     if no bytes are available.
    * @throws \RuntimeException if an error occurs.
    */
    public function read($length)
    {
        throw new \RuntimeException("Unsupported operation");
    }

    /**
    * Returns the remaining contents in a string
    *
    * @return string
    * @throws \RuntimeException if unable to read or an error occurs while
    *     reading.
    */
    public function getContents()
    {
        throw new \RuntimeException("Unsupported operation");
    }

}
