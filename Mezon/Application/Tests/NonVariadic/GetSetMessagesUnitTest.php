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
class GetSetMessagesUnitTest extends TestCase
{

    /**
     * Data provider for the test testGetSetMessages
     *
     * @return array
     */
    public function getSetMessagesDataProvider(): array
    {
        return [
            [
                new TestingPresenter()
            ],
            [
                new TestingPresenter(new TestingView(new HtmlTemplate(__DIR__ . '/../Res/', 'index')))
            ]
        ];
    }

    /**
     * Testing get/set method
     *
     * @dataProvider getSetMessagesDataProvider
     */
    public function testGetSetMessages(AbstractPresenter $presenter): void
    {
        // test body
        $presenter->setErrorCode(12);
        $presenter->setErrorMessage('msg2');
        $presenter->setSuccessMessage('msg4');

        // assertions
        $this->assertEquals(12, $presenter->getErrorCode());
        $this->assertEquals('msg2', $presenter->getErrorMessage());
        $this->assertEquals('msg4', $presenter->getSuccessMessage());
    }

    /**
     * Testing method setErrorMessage
     */
    public function testGetErrorMessageContent(): void
    {
        // setup
        $presenter = new TestingPresenter(new TestingView(new HtmlTemplate(__DIR__ . '/../Res/', 'index')));

        // test body
        $presenter->setErrorMessage('msg2');

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
        $presenter->setSuccessMessage('msg2');

        // assertions
        $this->assertEquals('msg 2', $presenter->getViewParameter('action-message'));
    }
}
