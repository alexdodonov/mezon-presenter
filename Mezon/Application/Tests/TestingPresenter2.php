<?php
namespace Mezon\Application\Tests;

use Mezon\Application\Presenter;

/**
 * Presenter class for testing purposes
 *
 * @author Dodonov A.A.
 */
class TestingPresenter2 extends Presenter
{

    public $defaultWasCalled = false;

    public function presenterDefault(): void
    {
        $this->defaultWasCalled = true;
    }
}
