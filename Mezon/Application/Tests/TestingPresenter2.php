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

    /**
     * Flag was presenter called
     *
     * @var boolean
     */
    public static $defaultWasCalled = false;

    public function presenterDefault(): void
    {
        self::$defaultWasCalled = true;
    }
}
