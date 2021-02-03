<?php
namespace Mezon\Application;

use Mezon\Conf\Conf;
use Mezon\Transport\RequestParams;

/**
 * Class VariadicPresenter
 *
 * @package Presenter
 * @subpackage VariadicPresenter
 * @author Dodonov A.A.
 * @version v.1.0 (2021/01/17)
 * @copyright Copyright (c) 2021, aeon.org
 */

/**
 * Base class for all controllers
 */
class VariadicPresenter extends AbstractPresenter
{

    // TODO use PresenterInterface because we do not need AbstractPresenter::$presenterName,
    // AbstractPresenter::$view and so on. All this data is stored in VariadicPresenter::$realPresenter

    /**
     * Config key to read settings
     *
     * @var string
     */
    protected $configKey = 'variadic-presenter-config-key';

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
    protected $remotePresenter = Presenter::class;

    /**
     * Constructor
     *
     * @param ViewInterface $view
     *            view
     * @param string $presenterName
     *            name of the presenter
     * @param RequestParams $requestParams
     *            request parameters
     * @param PresenterInterface $presenter
     *            presenter
     */
    public function __construct(
        ?ViewInterface $view = null,
        string $presenterName = '',
        ?RequestParams $requestParams = null,
        ?PresenterInterface $presenter = null)
    {
        parent::__construct($view, $presenterName, $requestParams);

        $this->setupRealPresenter(
            $this->configKey,
            $presenter,
            $this->localPresenter,
            $this->remotePresenter,
            [
                $view,
                $presenterName,
                $requestParams
            ]);
    }

    /**
     * Real presenter
     *
     * @var Presenter
     */
    private $realPresenter = null;

    /**
     * Method sets real presenter
     *
     * @param PresenterInterface $presenter
     */
    public function setRealPresenter(PresenterInterface $presenter): void
    {
        $this->realPresenter = $presenter;
    }

    /**
     * Method returns real presenter
     *
     * @return PresenterInterface|NULL real presenter
     */
    public function getRealPresenter(): ?PresenterInterface
    {
        return $this->realPresenter;
    }

    /**
     * Method setups real presenter
     *
     * @param string $configKey
     *            config key
     * @param ?Presenter $presenter
     *            presneter object
     * @param string $localPresenterClassName
     *            local presenter class name
     * @param string $remotePresenterClassName
     *            remote presenter class name
     * @param array $constructorParameters
     *            constructor parameters
     */
    protected function setupRealPresenter(
        string $configKey,
        ?Presenter $presenter,
        string $localPresenterClassName,
        string $remotePresenterClassName,
        array $constructorParameters = []): void
    {
        $presenterSetting = Conf::getConfigValue($configKey, 'local');

        list ($view, $presenterName, $requestParams) = empty($constructorParameters) ? [
            null,
            '',
            null
        ] : $constructorParameters;

        if ($presenter !== null) {
            $this->setRealPresenter($presenter);
        } elseif ($presenterSetting === 'local') {
            $this->setRealPresenter(new $localPresenterClassName($view, $presenterName, $requestParams));
        } elseif ($presenterSetting === 'remote') {
            $this->setRealPresenter(new $remotePresenterClassName($view, $presenterName, $requestParams));
        } else {
            $this->setRealPresenter(new $presenterSetting($view, $presenterName, $requestParams));
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see \Mezon\Application\AbstractPresenter::getErrorCode()
     */
    public function getErrorCode(): int
    {
        return $this->getRealPresenter()->getErrorCode();
    }

    /**
     *
     * {@inheritdoc}
     * @see \Mezon\Application\AbstractPresenter::setErrorCode()
     */
    public function setErrorCode(int $errorCode): void
    {
        $this->getRealPresenter()->setErrorCode($errorCode);
    }

    /**
     *
     * {@inheritdoc}
     * @see \Mezon\Application\AbstractPresenter::getErrorMessage()
     */
    public function getErrorMessage(): string
    {
        return $this->getRealPresenter()->getErrorMessage();
    }

    /**
     *
     * {@inheritdoc}
     * @see \Mezon\Application\AbstractPresenter::setErrorMessage()
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->getRealPresenter()->setErrorMessage($errorMessage);
    }

    /**
     *
     * {@inheritdoc}
     * @see \Mezon\Application\AbstractPresenter::run()
     */
    public function run(string $presenterName = '')
    {
        return $this->getRealPresenter()->run($presenterName);
    }
}
