<?php
namespace Mezon\Application;

use Mezon\Transport\RequestParamsInterface;
use Mezon\Transport\RequestParams;

/**
 * Class Presenter
 *
 * @package Mezon
 * @subpackage Presenter
 * @author Dodonov A.A.
 * @version v.1.0 (2020/01/12)
 * @copyright Copyright (c) 2020, aeon.org
 */

/**
 * Base class for all controllers
 */
class Presenter extends AbstractPresenter
{

    /**
     * Request params fetcher
     *
     * @var ?RequestParams
     */
    private $requestParams = null;

    /**
     * Constructor
     *
     * @param ViewInterface $view
     *            view object
     * @param string $presenterName
     *            Presenter name to be executed
     * @param ?RequestParams $requestParams
     *            request params fetcher
     */
    public function __construct(
        ?ViewInterface $view = null,
        string $presenterName = '',
        ?RequestParams $requestParams = null)
    {
        parent::__construct($view);

        $this->setPresenterName($presenterName);

        $this->requestParams = $requestParams;
    }

    /**
     * Method return $requestParams and thrown exception if it was not set
     *
     * @return RequestParamsInterface request params fetcher
     * @deprecated since 2020-07-06 use getRequestParamsFetcher
     * @codeCoverageIgnore
     */
    public function getParamsFetcher(): RequestParamsInterface
    {
        return $this->getRequestParamsFetcher();
    }

    /**
     * Method returns $this->requestParams and creates this object if necessery
     *
     * @return RequestParamsInterface
     */
    public function getRequestParamsFetcher(): RequestParamsInterface
    {
        if ($this->requestParams === null) {
            throw (new \Exception('Param fetcher was not setup'));
        }

        return $this->requestParams;
    }

    /**
     * Method runs controller
     *
     * @param
     *            string PresenterName
     *            Presenter name to be run
     * @return mixed result of the controller
     */
    public function run(string $presenterName = '')
    {
        if ($presenterName === '') {
            $presenterName = $this->getPresenterName();
        }

        if ($presenterName === '') {
            $presenterName = 'Default';
        }

        if (method_exists($this, 'presenter' . $presenterName)) {
            return call_user_func([
                $this,
                'presenter' . $presenterName
            ]);
        }

        throw (new \Exception('Presenter ' . $presenterName . ' was not found in the class ' . get_class($this)));
    }
}
