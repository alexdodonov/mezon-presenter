<?php
namespace Mezon\Application\Tests\Variadic;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Application\Tests\TestingPresenter;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class CallPresenterInVariadicPresenterUnitTest extends TestCase
{

    /**
     * Testing presenter running from the variadic one
     */
    public function testRunPresenterFromVariadic(): void
    {
        // setup
        TestingPresenter::$wasCalled = false;
        TestingVariadicPresenter::$wasCalled = false;
        Conf::setConfigValue('testing-variadic-presenter', new TestingPresenter());
        $presenter = new TestingVariadicPresenter(null, 'Result2', null);

        // test body
        $presenter->run();

        // assertions
        $this->assertFalse(TestingPresenter::$wasCalled);
        $this->assertTrue(TestingVariadicPresenter::$wasCalled);
    }
}
