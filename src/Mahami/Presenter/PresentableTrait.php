<?php namespace Mahami\Presenter;


use Mahami\Presenter\Exceptions\PresenterException;

/**
 * Class PresentableTrait
 * @package Acme\Presenters
 */
trait PresentableTrait {

    protected $presenterInstance;

    /**
     * @throws Exceptions\PresenterException
     * @return mixed
     */
    public function present()
    {
        if(! $this->presenter or ! class_exists($this->presenter))
        {
            throw new PresenterException("Please set the protected property to your presenter path");
        }

        if( ! $this->presenterInstance)
        {
            $this->presenterInstance =  new $this->presenter($this);
        }

        return $this->presenterInstance;
    }

} 
