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
class VariadicPresenter extends Presenter
{

    // TODO use AbstractPresenter instead of Presenter

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
     * @var ?Presenter
     */
    private $realPresenter = null;

    /**
     * Method sets real presenter
     *
     * @param Presenter $presenter
     */
    public function setRealPresenter(Presenter $presenter): void
    {
        $this->realPresenter = $presenter;
    }

    /**
     * Method returns real presenter
     *
     * @return Presenter real presenter
     */
    public function getRealPresenter(): Presenter
    {
        if ($this->realPresenter === null) {
            throw (new \Exception('Real presenter was not setup', - 1));
        }

        return $this->realPresenter;
    }

    /**
     * Method setups real presenter
     *
     * @param string $configKey
     *            config key
     * @param ?PresenterInterface $presenter
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
        ?PresenterInterface $presenter,
        string $localPresenterClassName,
        string $remotePresenterClassName,
        array $constructorParameters = []): void
    {
        $presenterSetting = Conf::getValue($configKey, 'local');

        list ($view, $presenterName, $requestParams) = empty($constructorParameters) ? [
            null,
            '',
            null
        ] : $constructorParameters;

        if ($presenter !== null) {
            // nop
        } elseif ($presenterSetting === 'local') {
            $presenter = new $localPresenterClassName($view, $presenterName, $requestParams);
        } elseif ($presenterSetting === 'remote') {
            $presenter = new $remotePresenterClassName($view, $presenterName, $requestParams);
        } else {
            /** @var class-string $presenterSetting */
            $presenter = new $presenterSetting($view, $presenterName, $requestParams);
        }

        if ($presenter instanceof Presenter) {
            $this->setRealPresenter($presenter);
        } else {
            throw (new \Exception(
                'Instance of the class "Presenter" must be used. Instance of the "' . get_class($presenter) .
                '" was passed',
                - 1));
        }
    }

    /**
     *
     * {@inheritdoc}
     * @see AbstractPresenter::getErrorCode()
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
     * @see AbstractPresenter::getErrorMessage()
     */
    public function getErrorMessage(): string
    {
        return $this->getRealPresenter()->getErrorMessage();
    }

    /**
     *
     * {@inheritdoc}
     * @see AbstractPresenter::setErrorMessage()
     */
    public function setErrorMessage(string $errorMessage): void
    {
        $this->getRealPresenter()->setErrorMessage($errorMessage);
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
        } elseif (method_exists($this->getRealPresenter(), 'presenter' . $presenterName)) {
            return call_user_func([
                $this->getRealPresenter(),
                'presenter' . $presenterName
            ]);
        }

        throw (new \Exception(
            'Presenter ' . $presenterName . ' was not found neither in the class ' . get_class($this) .
            ' nor in the class' . get_class($this->getRealPresenter())));
    }
}
