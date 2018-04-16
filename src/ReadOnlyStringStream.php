<?php

namespace Juhara\ZzzStream;

/**
 * Read-only string-based PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class ReadOnlyStringStream extends StringStream
{
    use ReadOnlyTrait;

    /**
     * generate meta data. keys are identical to stream_get_meta_data() output.
     * with mode is modified to read-only.
     * @return array meta data
     */
    protected function metaData()
    {
        $metaData = parent::metaData();
        $metaData['mode'] = 'r';
        return $metaData;
    }
}
