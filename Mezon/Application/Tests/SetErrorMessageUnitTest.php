<?php
namespace Mezon\Application\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;
use Mezon\Conf\Conf;

class SetErrorMessageUnitTest extends TestCase
{

    /**
     * Testing method setErrorMessage
     */
    public function testSetErroMessage(): void
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
