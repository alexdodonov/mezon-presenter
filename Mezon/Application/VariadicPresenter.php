<?php
namespace Mezon\Application;

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

    /**
     * Real presenter
     *
     * @var Presenter
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
     * @return Presenter|NULL real presenter
     */
    public function getRealPresenter(): ?Presenter
    {
        return $this->realPresenter;
    }
}
