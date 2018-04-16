<?php

namespace Juhara\ZzzStream;

/**
 * Decorator class that turn any PSR-7 StreamInterface into read-write stream
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class ReadWriteStream extends WrapperStream
{
    /**
     * modify mode of meta data using mode we pass as parameter
     * @param  string|null $key key used for access metadata
     * @param  array $metaData metadata
     * @param  string $mode     mode r, w
     * @return array|string|null modified matadata
     */
    private function changeMetadataMode($key, $metaData, $mode)
    {
        if (is_null($metaData)) {
            //null metadata means no value is found, just return as it is
            return $metaData;
        }

        if (is_null($key)) {
            //null key means, caller want to get all metadata array
            $metaData['mode'] = $mode;
        }

        if ($key === 'mode') {
            //key is equal to 'mode' then, metaData will contain value of mode
            $metaData = $mode;
        }
        return $metaData;
    }

    /**
     * get stream mode
     * 'rw' => read write, 'r' => read-only, 'w' => write-only
     * @return string mode
     */
    protected function mode()
    {
        return 'rw';
    }

    /**
     * Get stream metadata as an associative array or retrieve a specific key
     * but force mode into read-only
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
        $metaData = $this->actualStream->getMetadata($key);
        return $this->changeMetadataMode($key, $metaData, $this->mode());
    }
}
