<?php namespace spec\Mahami\Presenter;

use Mockery;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PresentableTraitSpec extends ObjectBehavior
{
    function let()
    {
        $this->beAnInstanceOf('spec\Mahami\Presenter\Foo');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('spec\Mahami\Presenter\Foo');
    }

    function it_fetches_a_valid_presenter()
    {
        Mockery::mock('FooPresenter');
        $this->present()->shouldBeAnInstanceOf('FooPresenter');
    }

    function it_throw_an_exception_if_invalid_presenter_is_provided()
    {
        $this->presenter = 'invalid';
        $this->shouldThrow('Mahami\Presenter\Exceptions\PresenterException')->duringPresent();
    }

    function it_caches_presenter_for_future_uses()
    {
        Mockery::mock('FooPresenter');

        $one = $this->present();
        $two = $this->present();

        $one->shouldBe($two);
    }
}

class Foo{
    use \Mahami\Presenter\PresentableTrait;
    public $presenter = 'FooPresenter';
}
