<?php

namespace Juhara\ZzzStream;

/**
 * Write-only string-based PSR-7 StreamInterface implementation
 *
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
class WriteOnlyStringStream extends StringStream
{
    use WriteOnlyTrait;

    /**
     * generate meta data. keys are identical to stream_get_meta_data() output.
     * with mode is modified to write only
     * @return array meta data
     */
    protected function metaData()
    {
        $metaData = parent::metaData();
        $metaData['mode'] = 'w';
        return $metaData;
    }
}
