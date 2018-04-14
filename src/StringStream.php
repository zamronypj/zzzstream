<?php

namespace Juhara\ZzzStream;

use Psr\Http\Message\StreamInterface;
use RuntimeException;

/**
 * String-based PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class StringStream implements StreamInterface
{
    /**
     * string data
     * @var string
     */
    private $strData = null;

    /**
     * index for seeking in string
     * @var int
     */
    private $strIndex = 0;

    /**
     * constructor
     * @param string $inputStr input string
     */
    public function __construct($inputStr)
    {
        $this->strData = $inputStr;
        $this->strIndex = 0;
    }

    /**
     * trigger exception when string data is null
     * @return void
     * @throws RuntimeException
     */
    private function triggerExceptionIfInvalidString()
    {
        if (is_null($this->strData)) {
            //if we get here then this is due to our stream
            //is closed or detached
            throw new RuntimeException('Invalid string data');
        }
    }

    /**
    * Reads all data from the stream into a string, from the beginning to end.
    *
    * This method MUST attempt to seek to the beginning of the stream before
    * reading data and read the stream until the end is reached.
    *
    * Warning: This could attempt to load a large amount of data into memory.
    *
    * This method MUST NOT raise an exception in order to conform with PHP's
    * string casting operations.
    *
    * @see http://php.net/manual/en/language.oop5.magic.php#object.tostring
    * @return string
    */
    public function __toString()
    {
        return is_null($this->strData) ? '' : $this->strData;
    }

    /**
    * Closes the stream and any underlying resources.
    *
    * @return void
    */
    public function close()
    {
        $this->strData = null;
    }

    /**
    * Separates any underlying resources from the stream.
    *
    * After the stream has been detached, the stream is in an unusable state.
    *
    * @return resource|null Underlying PHP stream, if any
    */
    public function detach()
    {
        $originalData = $this->strData;
        $this->strData = null;
        return $originalData;
    }

    /**
    * Get the size of the stream if known.
    *
    * @return int|null Returns the size in bytes if known, or null if unknown.
    */
    public function getSize()
    {
        return is_null($this->strData) ? null : strlen($this->strData);
    }

    /**
    * Returns the current position of the file read/write pointer
    *
    * @return int Position of the file pointer
    * @throws RuntimeException on error.
    */
    public function tell()
    {
        $this->triggerExceptionIfInvalidString();
        return $this->strIndex;
    }

    /**
    * Returns true if the stream is at the end of the stream.
    *
    * @return bool
    */
    public function eof()
    {
        return (($this->strIndex-1) >= strlen($this->strData));
    }

    /**
    * Returns whether or not the stream is seekable.
    *
    * @return bool
    */
    public function isSeekable()
    {
        return true;
    }

    /**
    * Seek to a position in the stream.
    *
    * @link http://www.php.net/manual/en/function.fseek.php
    * @param int $offset Stream offset
    * @param int $whence Specifies how the cursor position will be calculated
    *     based on the seek offset. Valid values are identical to the built-in
    *     PHP $whence values for `fseek()`.  SEEK_SET: Set position equal to
    *     offset bytes SEEK_CUR: Set position to current location plus offset
    *     SEEK_END: Set position to end-of-stream plus offset.
    * @throws RuntimeException on failure.
    */
    public function seek($offset, $whence = SEEK_SET)
    {
        $this->triggerExceptionIfInvalidString();

        switch ($whence) {
            case SEEK_SET :
                $this->strIndex = $offset;
                break;
            case SEEK_CUR :
                $this->strIndex = $this->strIndex + $offset;
                break;
            case SEEK_END :
                $this->strIndex = $this->getSize() + $offset;
                break;
            default :
                throw new RuntimeException('Unknown whence value');
        }
    }

    /**
    * Seek to the beginning of the stream.
    *
    * If the stream is not seekable, this method will raise an exception;
    * otherwise, it will perform a seek(0).
    *
    * @see seek()
    * @link http://www.php.net/manual/en/function.fseek.php
    * @throws RuntimeException on failure.
    */
    public function rewind()
    {
        $this->triggerExceptionIfInvalidString();
        $this->seek(0);
    }

    /**
    * Returns whether or not the stream is writable.
    *
    * @return bool
    */
    public function isWritable()
    {
        return true;
    }

    /**
    * Write data to the stream.
    *
    * @param string $string The string that is to be written.
    * @return int Returns the number of bytes written to the stream.
    * @throws RuntimeException on failure.
    */
    public function write($string)
    {
        $this->triggerExceptionIfInvalidString();
        $this->strData = substr($this->strData, 0 , $this->strIndex) . $string;
        $this->seek(strlen($string));
    }

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
    * @throws RuntimeException if an error occurs.
    */
    public function read($length)
    {
        $this->triggerExceptionIfInvalidString();

        $remainingLength = $this->getSize() - $this->strIndex;
        if ($remainingLength <= 0) {
            return '';
        }

        $len = $remainingLength >= $length ? $length : $remainingLength;
        $strRead = substr($this->strData, $this->strIndex, $len);
        $this->seek($len);
        return $strRead;
    }

    /**
    * Returns the remaining contents in a string
    *
    * @return string
    * @throws RuntimeException if unable to read or an error occurs while
    *     reading.
    */
    public function getContents()
    {
        $this->triggerExceptionIfInvalidString();
        return $this->read($this->getSize());
    }

    /**
    * Get stream metadata as an associative array or retrieve a specific key.
    *
    * The keys returned are identical to the keys returned from PHP's
    * stream_get_meta_data() function.
    *
    * @link http://php.net/manual/en/function.stream-get-meta-data.php
    * @param string $key Specific metadata to retrieve.
    * @return array|mixed|null Returns an associative array if no key is
    *     provided. Returns a specific key value if a key is provided and the
    *     value is found, or null if the key is not found.
    */
    public function getMetadata($key = null)
    {
        $metaData = [
            'wrapper_data' => ['string'],
            'wrapper_type' => 'string',
            'stream_type' => 'string',
            'mode' => 'rw',
            'unread_bytes' => $this->getSize() - $this->strIndex,
            'seekable' => $this->isSeekable(),
            'timeout' => false,
            'blocked' => true,
            'eof' => $this->eof()
        ];

        if (is_null($key)) {
            return $metaData;
        }

        if (isset($metaData[$key]))
        {
            return $metaData[$key];
        }

        return null;
    }

}
