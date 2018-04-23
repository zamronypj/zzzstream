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
        $stream->close();
        $this->assertEquals($inputString, $outputString);
    }

    public function testWriteShouldResultCorrectSize()
    {
        $stream =  new TempStream();
        $inputString = 'We Love You';
        $stream->write($inputString);
        $size = $stream->getSize();
        $stream->close();
        $this->assertEquals($size, strlen($inputString));
    }

    public function testWriteShouldMovePointerToCorrectPosition()
    {
        $stream =  new TempStream();
        $inputString = 'We Love You';
        $stream->write($inputString);
        $pos = $stream->tell();
        $stream->close();
        $this->assertEquals($pos, strlen($inputString));
    }

    public function testWriteMultipleStringShouldAppendText()
    {
        $stream =  new TempStream();
        $inputString1 = 'We Love You';
        $inputString2 = 'They Love You';
        $stream->write($inputString1);
        $stream->write($inputString2);
        $outputString = (string) $stream;
        $stream->close();
        $this->assertEquals($inputString1 . $inputString2, $outputString);
    }

    public function testWriteShouldResultSameStringWhenRead()
    {
        $stream =  new TempStream();
        $inputString = 'We Love You';
        $stream->write($inputString);
        $stream->rewind();
        $outputString = $stream->read(strlen($inputString));
        $stream->close();
        $this->assertEquals($inputString, $outputString);
    }

    public function testReadShouldResultCorrectString()
    {
        $stream =  new TempStream();
        $inputString = 'We Love You';
        $stream->write($inputString);
        $stream->rewind();
        $outputString = $stream->read(2);
        $stream->close();
        $this->assertEquals($outputString, 'We');
    }
}
