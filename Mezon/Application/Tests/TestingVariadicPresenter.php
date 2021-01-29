<?php
namespace Mezon\Application\Tests;

use Mezon\Application\VariadicPresenter;
use Mezon\Application\Presenter;
use Mezon\Transport\RequestParams;
use Mezon\Application\ViewInterface;

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
}
