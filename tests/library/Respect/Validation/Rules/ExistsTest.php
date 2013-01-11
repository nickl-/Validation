<?php

namespace Respect\Validation\Rules;

class ExistsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @dataProvider providerForValidExists
     */
    public function testValidFileOrDirectoryShouldReturnTrue($input)
    {
        $rule = new Exists();
        $this->assertTrue($rule->validate($input));
        $this->assertTrue($rule->assert($input));
        $this->assertTrue($rule->check($input));
    }

    /**
     * @dataProvider providerForInvalidExists
     * @expectedException Respect\Validation\Exceptions\ExistsException
     */
    public function testInvalidFileOrDirectoryShouldThrowExistsException($input)
    {
        $rule = new Exists();
        $this->assertFalse($rule->validate($input));
        $this->assertFalse($rule->assert($input));
        $this->assertFalse($rule->check($input));
    }

    /**
     * @dataProvider providerForExistsObjects
     */
    public function testFileOrDirectoryWithObjects($object, $valid)
    {
        $rule = new Exists();
        $this->assertEquals($valid, $rule->validate($object));
    }

    public function providerForExistsObjects()
    {
        return array(
            array(new \SplFileInfo(__DIR__), true),
            array(new \SplFileInfo(__FILE__), true),
            array(new \SplFileObject(__FILE__), true),

            array(new \SplFileInfo(__DIR__ . '/tulips.png'), false),
        );
    }

    public function providerForValidExists()
    {
        return array_chunk(
            array(
                __DIR__,
                __FILE__,
                __DIR__ . '/../../../../',
                __DIR__ . '/../../../../../README.md',
                __DIR__ . '/../../../../../composer.json',
            ),
            1
        );
    }

    public function providerForInvalidExists()
    {
        return array_chunk(
            array(
                __FILE__ . '/',
                __DIR__ . '/SomeDir',
                new \stdClass(),
                array(__DIR__),
            ),
            1
        );
    }

}