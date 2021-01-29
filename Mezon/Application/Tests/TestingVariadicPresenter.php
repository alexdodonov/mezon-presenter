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
     * Constructor
     *
     * @param ViewInterface $view
     *            view
     * @param string $presenterName
     *            name of the presenter
     * @param RequestParams $requestParams
     *            request parameters
     * @param Presenter $presenter
     *            presenter
     */
    public function __construct(
        ?ViewInterface $view = null,
        string $presenterName = '',
        ?RequestParams $requestParams = null,
        ?Presenter $presenter = null)
    {
        parent::__construct();

        $this->setupRealPresenter(
            'testing-variadic-presenter',
            $presenter,
            Presenter::class,
            TestingPresenter::class);
    }
}
