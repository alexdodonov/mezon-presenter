<?php
namespace Mezon\Application\Tests\NonVariadic;

use Mezon\Transport\HttpRequestParams;
use Mezon\Router\Router;
use Mezon\HtmlTemplate\HtmlTemplate;
use Mezon\ViewInterface;
use PHPUnit\Framework\TestCase;
use Mezon\Application\Tests\TestingPresenter;
use Mezon\Tests\TestingView;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class PresenterUnitTest extends TestCase
{

    /**
     * Testing constructor
     */
    public function testConstructor(): void
    {
        // setupp
        $presenter = new TestingPresenter(new TestingView(), 'Test');

        $this->assertEquals('Test', $presenter->getPresenterName(), 'Invalid constructor call');
    }

    /**
     * Testing render
     */
    public function testRender(): void
    {
        // setupp
        $presenter = new TestingPresenter(new TestingView(), 'Test');

        $this->assertEquals('computed content', $presenter->run(), 'Invalid controller execution');
        $this->assertEquals('computed content 2', $presenter->run('test2'), 'Invalid controller execution');
    }

    /**
     * Testing default controller
     */
    public function testDefault(): void
    {
        // setupp
        $presenter = new TestingPresenter(new TestingView());

        // assertionss
        $this->expectExceptionMessage('Presenter Default was not found');

        // test bodyy
        $presenter->run();
    }

    /**
     * Testing method setPresenterName
     */
    public function testSetPresenterName(): void
    {
        // setup
        $presenter = new TestingPresenter(new TestingView());

        // test body
        $presenter->setPresenterName('SomeName');

        // assertions
        $this->assertEquals('SomeName', $presenter->getPresenterName());
    }

    /**
     * Testing method getRequestParamsFetcher
     */
    public function testGetParamsFetcher(): void
    {
        // setup
        $router = new Router();
        $presenter = new TestingPresenter(new TestingView(), '', new HttpRequestParams($router));

        // test body
        $fetcher = $presenter->getRequestParamsFetcher();

        // assertions
        $this->assertInstanceOf(HttpRequestParams::class, $fetcher);
    }

    /**
     * Testing method getRequestParamsFetcher with exception
     */
    public function testGetParamsFetcherWithException(): void
    {
        // setup
        $presenter = new TestingPresenter(new TestingView());

        // assertions
        $this->expectException(\Exception::class);

        // test body
        $presenter->getRequestParamsFetcher();
    }

    /**
     * Testing get/set method
     */
    public function testNullViewInPresenterConstructor(): void
    {
        // setup
        $presenter = new TestingPresenter(null);

        // test body
        $presenter->setErrorCode(11);
        $presenter->setErrorMessage('msg1');

        // assertions
        $this->assertEquals(11, $presenter->getErrorCode());
        $this->assertEquals('msg1', $presenter->getErrorMessage());
    }
}
