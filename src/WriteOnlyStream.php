<?php

namespace Juhara\ZzzStream;

/**
 * Decorator class that turn any PSR-7 StreamInterface into write only stream
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class WriteOnlyStream extends WrapperStream
{
    use WriteOnlyTrait, MetadataModeManipulatorTrait;

    /**
     * Get stream metadata as an associative array or retrieve a specific key
     * but force mode into write only
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
        return $this->changeMetadataMode($key, $metaData, 'w');
    }
}
