<?php

namespace NewRelic;

class NewRelicTest extends \PHPUnit_Framework_TestCase
{

    const APP_NAME = 'php-newrelic-test';

    public function setUp()
    {
        if (!extension_loaded('newrelic')) {
            $this->markTestSkipped('The NewRelic extension is not available.');
        }
    }

    public function testInstances()
    {
        $newRelic = new NewRelic;
        $this->assertInstanceOf('\\NewRelic\\NewRelic', $newRelic);

        $newRelicConfig = new NewRelic(array('name' => self::APP_NAME));
        $this->assertInstanceOf('\\NewRelic\\NewRelic', $newRelic);

        $newRelicAgent = new NewRelicAgent;
        $this->assertInstanceOf('\\NewRelic\\NewRelic', $newRelicAgent);
    }

    public function testIsLoaded()
    {
        $isLoaded = NewRelic::isLoaded();
        $this->assertTrue($isLoaded);
    }

    public function testGetInstance()
    {
        $newRelic = NewRelic::getInstance();
        $this->assertInstanceOf('\\NewRelic\\NewRelic', $newRelic);
    }

    public function testCall()
    {
        $newRelic = new NewRelic;
        $prefix = 'window.NREUM';
        $rumHeader = NewRelic::getBrowserTimingHeader(false);
        $this->assertStringStartsWith($prefix, $rumHeader);
    }

    public function testCallStatic()
    {
        $prefix = 'window.NREUM';
        $rumFooter = NewRelic::getBrowserTimingFooter(false);
        $this->assertStringStartsWith($prefix, $rumFooter);
    }

    public function testWrongMethod()
    {
        $wrongMethod = NewRelic::iDoNotExist();
        $this->assertFalse($wrongMethod);
    }

}
