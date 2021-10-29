<?php
namespace Mezon\Application\Tests\Variadic;

use Mezon\Application\VariadicPresenter;
use Mezon\Application\Presenter;
use Mezon\Application\Tests\TestingPresenter;

/**
 * Presenter class for testing purposes
 *
 * @author Dodonov A.A.
 */
class TestingVariadicPresenter extends VariadicPresenter
{

    /**
     * Config key to read presenter settings
     *
     * @var string
     */
    protected $configKey = 'testing-variadic-presenter';

    /**
     * Local presenter class name
     *
     * @var string
     */
    protected $localPresenter = Presenter::class;

    /**
     * Remote presenter class name
     *
     * @var string
     */
    protected $remotePresenter = TestingPresenter::class;

    /**
     * Flag was presenter executed
     *
     * @var boolean
     */
    public static $wasCalled = false;

    public function presenterResult2(): void
    {
        self::$wasCalled = true;
    }
}
