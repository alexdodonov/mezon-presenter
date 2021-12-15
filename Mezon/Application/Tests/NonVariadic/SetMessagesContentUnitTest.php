<?php
namespace Mezon\Application\Tests\NonVariadic;

use Mezon\HtmlTemplate\HtmlTemplate;
use Mezon\Application\AbstractPresenter;
use PHPUnit\Framework\TestCase;
use Mezon\Application\Tests\TestingPresenter;
use Mezon\Tests\TestingView;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SetMessagesContentUnitTest extends TestCase
{

    /**
     * Testing method setErrorMessage
     */
    public function testGetErrorMessageContent(): void
    {
        // setup
        $presenter = new TestingPresenter(new TestingView(new HtmlTemplate(__DIR__ . '/../Res/', 'index')));

        // test body
        $presenter->setErrorMessageContent('msg2');

        // assertions
        $this->assertEquals('msg 2', $presenter->getViewParameter('action-message'));
    }

    /**
     * Testing method setSuccessMessage
     */
    public function testGetSuccessMessageContent(): void
    {
        // setup
        $presenter = new TestingPresenter(new TestingView(new HtmlTemplate(__DIR__ . '/../Res/', 'index')));

        // test body
        $presenter->setSuccessMessageContent('msg2');

        // assertions
        $this->assertEquals('msg 2', $presenter->getViewParameter('action-message'));
    }
}
