<?php
namespace Mezon\Application\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;

class SetErrorCodeUnitTest extends TestCase
{

    /**
     * Testing method setErrorCode
     */
    public function testSetErroCode(): void
    {
        // setup
        $presenter = new VariadicPresenter();

        // test body
        $presenter->setErrorCode(123);

        // assertions
        $this->assertEquals(123, $presenter->getErrorCode());
    }
}
