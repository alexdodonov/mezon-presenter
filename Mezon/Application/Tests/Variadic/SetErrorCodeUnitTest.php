<?php
namespace Mezon\Application\Tests\Variadic;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SetErrorCodeUnitTest extends TestCase
{

    /**
     * Testing method setErrorCode
     */
    public function testSetErroCode(): void
    {
        // setup
        Conf::setConfigValue('variadic-presenter-config-key', 'local');
        $presenter = new VariadicPresenter();

        // test body
        $presenter->setErrorCode(123);

        // assertions
        $this->assertEquals(123, $presenter->getErrorCode());
    }
}
