<?php

namespace Juhara\ZzzStream;

/**
 * Decorator class that turn any PSR-7 StreamInterface into write only stream
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class WriteOnlyStream extends WrapperStream
{
    /**
     * Returns whether or not the stream is readable.
     *
     * @return bool
     */
    public function isReadable()
    {
        return false;
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
        throw new \RuntimeException('Unsupported operation');
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
        throw new \RuntimeException('Unsupported operation');
    }

}
