<?php
namespace Juhara\ZzzStream\Tests;

use Juhara\ZzzStream\WriteOnlyStringStream;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * WriteOnlyStringStream tests
 * @author Zamrony P. Juhara <zamronypj@yahoo.com>
 */
final class WriteOnlyStringStreamTest extends TestCase
{
    public function testConstructorShouldResultSameStringWhenTypecastToString()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $outputString = (string) $stream;
        $this->assertEquals($inputString, $outputString);
    }

    public function testConstructorStreamPointerShouldBeAtEnd()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $this->assertEquals($stream->tell(), strlen($inputString));
    }

    public function testRewindStreamPointerShouldBeAtBeginning()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->rewind();
        $this->assertEquals($stream->tell(), 0);
    }

    public function testConstructorStreamSizeShouldBeSameAsInputStringLength()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $this->assertEquals($stream->getSize(), strlen($inputString));
    }

    public function testReadFixedLengthFromStreamShouldResultCorrectString()
    {
        $this->setExpectedException(RuntimeException::class);
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->rewind();
        $stringRead = $stream->read(7);
    }

    public function testGetContentsFromStreamShouldResultCorrectString()
    {
        $this->setExpectedException(RuntimeException::class);
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->rewind();
        $stringRead = $stream->getContents();
    }

    public function testWriteToStreamShouldResultCorrectString()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->write(' Dear');
        $outputString = (string) $stream;
        $this->assertEquals($outputString, 'We Love You Dear');
    }

    public function testSeekToBeginningWithoutSecondParamShouldMovePositionToBeginning()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->seek(0);
        $this->assertEquals($stream->tell(), 0);
    }

    public function testSeekToOffsetWithoutSecondParamShouldMovePositionToCorrectPosition()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->seek(3);
        $this->assertEquals($stream->tell(), 3);
    }

    public function testSeekToOffsetShouldMovePositionToCorrectPosition()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->seek(3, SEEK_SET);
        $this->assertEquals($stream->tell(), 3);
    }

    public function testRewindShouldMovePositionToBeginning()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->rewind();
        $this->assertEquals($stream->tell(), 0);
    }

    public function testSeekNegativeOffsetFromCurrentPosShouldMovePositionToCorrectPosition()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->seek(-3, SEEK_CUR);
        $this->assertEquals($stream->tell(), strlen($inputString) - 3);
    }

    public function testSeekPositifOffsetFromCurrentPosShouldMovePositionToCorrectPosition()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->rewind();
        $stream->seek(3, SEEK_CUR);
        $this->assertEquals($stream->tell(), 3);
    }

    public function testSeekNegativeOffsetFromEndPosShouldMovePositionToCorrectPosition()
    {
        $inputString = 'We Love You';
        $stream =  new WriteOnlyStringStream($inputString);
        $stream->seek(-3, SEEK_END);
        $this->assertEquals($stream->tell(), strlen($inputString) - 3);
    }
}
