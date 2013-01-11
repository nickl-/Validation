<?php

namespace Respect\Validation\Rules;

class FileTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidFile
     */
    public function testValidFileShouldReturnTrue($input)
    {
        $rule = new File();
        $this->assertTrue($rule->validate($input));
        $this->assertTrue($rule->assert($input));
        $this->assertTrue($rule->check($input));
    }

    /**
     * @dataProvider providerForInvalidFile
     * @expectedException Respect\Validation\Exceptions\FileException
     */
    public function testInvalidFileShouldThrowException($input)
    {
        $rule = new File();
        $this->assertFalse($rule->validate($input));
        $this->assertFalse($rule->assert($input));
        $this->assertFalse($rule->check($input));
    }

    /**
     * @dataProvider providerForFileObjects
     */
    public function testFileWithObjects($object, $valid)
    {
        $rule = new File();
        $this->assertEquals($valid, $rule->validate($object));
    }

    public function providerForFileObjects()
    {
        return array(
            array(new \SplFileInfo(__FILE__), true),
            array(new \SplFileInfo(__DIR__), false),
            array(new \SplFileObject(__FILE__), true),
        );
    }

    public function providerForValidFile()
    {
        return array_chunk(
            array(
                __FILE__,
                __DIR__ . '/../../../../../README.md',
                __DIR__ . '/../../../../../composer.json',
                __DIR__ . '/../Exceptions/ValidationExceptionTest.php',
            ),
            1
        );
    }

    public function providerForInvalidFile()
    {
        return array_chunk(
            array(
                __DIR__,
                __DIR__ . '/../../../../..',
                new \stdClass(),
                array(__DIR__),
            ),
            1
        );
    }

}