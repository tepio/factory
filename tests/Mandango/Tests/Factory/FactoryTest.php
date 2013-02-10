<?php
namespace Mandango\Factory\Tests;
use Mandango\Tests\TestCase;
use Mandango\Factory\Factory;

class FactoryTest extends TestCase {
    public function testConstructor() 
    {
        $factory = new Factory($this->mandango, $this->faker);
        $this->assertInstanceOf('Mandango\Mandango', $factory->getMandango());
    }

    public function testConfigs()
    {
        $factory = new Factory($this->mandango, $this->faker);
        $factory->setConfigClasses(self::$staticConfigClasses);

        $this->assertTrue($factory->hasConfigClass('Model\Article'));
    }

    public function testBlueprint()
    {
        $factory = new Factory($this->mandango, $this->faker);
        $factory->setConfigClasses(self::$staticConfigClasses);

        $this->assertTrue($factory->hasConfigClass('Model\Article'));
        $this->assertFalse($factory->hasBlueprint('Article'));

        $blueprint = $factory->define('Article', 'Model\Article');
        $this->assertInstanceOf('Mandango\Factory\Blueprint', $blueprint);

        $this->assertTrue($factory->hasBlueprint('Article'));

        $document = $factory->create('Article', array(), false);
        $this->assertInstanceOf('Model\Article', $document);
    }
}