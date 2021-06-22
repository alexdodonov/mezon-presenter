<?php
namespace Mezon\Application\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;

/** @psalm-suppress PropertyNotSetInConstructor */
class VariadicPresenterRunUnitTest extends TestCase
{

    /**
     * Testing method run when presenter name is set in constructor
     */
    public function testRunFromStoredPresenterName(): void
    {
        // setup
        Conf::setConfigValue('testing-variadic-presenter', new TestingPresenter());
        $presenter = new TestingVariadicPresenter(null, 'Result', null);

        // test body
        $presenter->run();

        // assertions
        $this->assertTrue($presenter->getRealPresenter()->wasCalled);
    }

    /**
     * Testing method run when presenter name is passed in run method
     */
    public function testRunFromPassedPresenterName(): void
    {
        // setup
        Conf::setConfigValue('testing-variadic-presenter', new TestingPresenter());
        $presenter = new TestingVariadicPresenter();

        // test body
        $presenter->run('Result');

        // assertions
        $this->assertTrue($presenter->getRealPresenter()->wasCalled);
    }

    /**
     * Testing method run with default presenter name
     */
    public function testRunFromDefaultPresenterName(): void
    {
        // setup
        Conf::setConfigValue('testing-variadic-presenter', new TestingPresenter2());
        $presenter = new TestingVariadicPresenter();

        // test body
        $presenter->run();

        // assertions
        $this->assertTrue($presenter->getRealPresenter()->defaultWasCalled);
    }

    /**
     * Testing exception
     */
    public function testExceptionForUnexistingPresenter(): void
    {
        // assertions
        $this->expectException(\Exception::class);

        // setup
        Conf::setConfigValue('testing-variadic-presenter', new TestingPresenter());
        $presenter = new TestingVariadicPresenter();

        // test body
        $presenter->run('UnexistingPresenter');
    }
}
