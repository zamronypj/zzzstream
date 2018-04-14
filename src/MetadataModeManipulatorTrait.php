<?php

namespace Juhara\ZzzStream;

/**
 * trait that manipulates mode metadata
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
trait MetadataModeManipulatorTrait
{
    /**
     * modify mode of meta data using mode we pass as parameter
     * @param  string|null $key key used for access metadata
     * @param  array $metaData metadata
     * @param  string $mode     mode r, w
     * @return array|string|null modified matadata
     */
    protected function changeMetadataMode($key, $metaData, $mode)
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

}
