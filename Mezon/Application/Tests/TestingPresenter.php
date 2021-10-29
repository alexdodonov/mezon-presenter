<?php
namespace Mezon\Application\Tests;

use Mezon\Application\Presenter;

/**
 * Presenter class for testing purposes
 *
 * @author Dodonov A.A.
 */
class TestingPresenter extends Presenter
{

    public function presenterTest(): string
    {
        return 'computed content';
    }

    public function presenterTest2(): string
    {
        return 'computed content 2';
    }

    /**
     * Flag was presenter called
     *
     * @var boolean
     */
    public static $wasCalled = false;

    public function presenterResult(): void
    {
        self::$wasCalled = true;
    }

    /**
     * Was presenter called
     * 
     * @var boolean
     */
    public static $actionPresenterFromConfigWasCalled = false;

    public function presenterFromConfig(): void
    {
        TestingPresenter::$actionPresenterFromConfigWasCalled = true;
    }
}
