<?php
namespace Mezon\Application\Tests\Variadic;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class GetRealPresenterUnitTest extends TestCase
{

    /**
     * Testing exception while getting real presenter
     */
    public function testException(): void
    {
        // assertions
        $this->expectException(\Exception::class);
        $this->expectExceptionCode(- 1);
        $this->expectExceptionMessage('Real presenter was not setup');

        // setup
        Conf::setConfigStringValue('variadic-presenter-config-key', 'local');
        $variadicPresenter = new VariadicPresenter();
        $variadicPresenter->setRealPresenter(null);

        // test body
        $variadicPresenter->getRealPresenter();
    }
}
