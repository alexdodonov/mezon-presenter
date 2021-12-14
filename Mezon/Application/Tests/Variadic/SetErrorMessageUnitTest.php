<?php
namespace Mezon\Application\Tests\Variadic;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;
use Mezon\Conf\Conf;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SetErrorMessageUnitTest extends TestCase
{

    /**
     * Testing method setErrorMessage
     */
    public function testSetErrorMessage(): void
    {
        // setup
        Conf::setConfigValue('variadic-presenter-config-key', 'local');
        $presenter = new VariadicPresenter();

        // test body
        $presenter->setErrorMessage('123');

        // assertions
        $this->assertEquals('123', $presenter->getErrorMessage());
    }
}
