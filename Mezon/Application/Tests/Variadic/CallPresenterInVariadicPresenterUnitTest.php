<?php
namespace Mezon\Application\Tests\Variadic;

use PHPUnit\Framework\TestCase;
use Mezon\Conf\Conf;
use Mezon\Application\Tests\TestingPresenter;

class CallPresenterInVariadicPresenterUnitTest extends TestCase
{

    /**
     * Testing presenter running from the variadic one
     */
    public function testRunPresenterFromVariadic(): void
    {
        // setup
        Conf::setConfigValue('testing-variadic-presenter', new TestingPresenter());
        $presenter = new TestingVariadicPresenter(null, 'Result2', null);

        // test body
        $presenter->run();

        // assertions
        $this->assertFalse($presenter->getRealPresenter()->wasCalled);
        $this->assertTrue($presenter->wasCalled);
    }
}
