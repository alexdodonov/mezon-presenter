<?php
namespace Mezon\Application\Tests\Variadic;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SetRealPresenterUnitTest extends TestCase
{

    /**
     * Testing method setRealPresenter
     */
    public function testSetRealPresenter(): void
    {
        // setup
        Conf::setConfigValue('variadic-presenter-config-key', 'local');
        $presenter = new VariadicPresenter();

        // test body
        $presenter->setRealPresenter($presenter);

        // assertions
        $this->assertInstanceOf(VariadicPresenter::class, $presenter->getRealPresenter());
    }
}
