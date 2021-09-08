<?php
namespace Mezon\Application\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;

class SetErrorMessageUnitTest extends TestCase
{

    /**
     * Testing method setErrorMessage
     */
    public function testSetErroMessage(): void
    {
        // setup
        $presenter = new VariadicPresenter();

        // test body
        $presenter->setErrorMessage('123');

        // assertions
        $this->assertEquals('123', $presenter->getErrorMessage());
    }
}
