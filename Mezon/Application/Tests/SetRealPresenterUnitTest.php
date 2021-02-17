<?php
namespace Mezon\Application\Tests;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;
use Mezon\Conf\Conf;
use Mezon\Application\Presenter;

class SetRealPresenterUnitTest extends TestCase
{

    /**
     * Testing method setRealPresenter
     */
    public function testSetRealPresenter(): void
    {
        // setup
        $presenter = new VariadicPresenter();

        // test body
        $presenter->setRealPresenter($presenter);

        // assertions
        $this->assertInstanceOf(VariadicPresenter::class, $presenter->getRealPresenter());
    }
}
