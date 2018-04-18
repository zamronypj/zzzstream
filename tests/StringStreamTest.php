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

    public function testConstructorStreamPointerShouldBeAtEnd()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $this->assertEquals($stream->tell(), strlen($inputString));
    }

    public function testRewindStreamPointerShouldBeAtBeginning()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $stream->rewind();
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
        $stream->rewind();
        $stringRead = $stream->read(7);
        $this->assertEquals($stringRead, 'We Love');
    }

    public function testGetContentsFromStreamShouldResultCorrectString()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $stream->rewind();
        $stringRead = $stream->getContents();
        $this->assertEquals($stringRead, 'We Love You');
    }

    public function testWriteToStreamShouldResultCorrectString()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $stream->write(' Dear');
        $stringRead = (string) $stream;
        $this->assertEquals($stringRead, 'We Love You Dear');
    }

    public function testWriteToStreamShouldMovePositionToEnd()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $stream->write(' Dear');
        $stringRead = (string) $stream;
        $this->assertEquals($stream->tell(), strlen('We Love You Dear'));
    }

    public function testSeekToBeginningShouldMovePositionToBeginning()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $stream->seek(0);
        $this->assertEquals($stream->tell(), 0);
    }

    public function testSeekNegativeOffsetFromCurrentPosShouldMovePositionToCorrectPosition()
    {
        $inputString = 'We Love You';
        $stream =  new StringStream($inputString);
        $stream->seek(-3, SEEK_CUR);
        $this->assertEquals($stream->tell(), strlen($inputString) - 3);
    }
}
