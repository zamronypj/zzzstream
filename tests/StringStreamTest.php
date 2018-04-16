<?php
namespace Juhara\ZzzStream\Tests;

use Juhara\ZzzStream\StringStream;
use PHPUnit\Framework\TestCase;

/**
 * StringStream tests
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
final class StringStreamTest extends TestCase
{
    public function testConstructorShouldResultSameStringWhenTypecastToString()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $outputString = (string) $stream;
        $this->assertEquals($inputString, $outputString);
    }

    public function testConstructorStreamPointerShouldBeAtBeginning()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $this->assertEquals($stream->tell(), 0);
    }

    public function testConstructorStreamSizeShouldBeSameAsInputStringLength()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $this->assertEquals($stream->getSize(), strlen($inputString));
    }

    public function testReadFixedLengthFromStreamShouldResultCorrectString()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $stringRead = $stream->read(7);
        $this->assertEquals($stringRead, 'We Love');
    }
}
