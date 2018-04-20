<?php
namespace Juhara\ZzzStream\Tests;

use Juhara\ZzzStream\TempStream;
use PHPUnit\Framework\TestCase;

/**
 * TempStream tests
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
final class TempStreamTest extends TestCase
{
    public function testWriteShouldResultSameStringWhenTypecastToString()
    {
        $stream =  new TempStream();
        $inputString = 'We Love You';
        $stream->write($inputString);
        $outputString = (string) $stream;
        $this->assertEquals($inputString, $outputString);
    }
}
