<?php
namespace Mezon\Application\Tests\NonVariadic;

use Mezon\HtmlTemplate\HtmlTemplate;
use Mezon\ViewInterface;
use PHPUnit\Framework\TestCase;
use Mezon\Application\Tests\TestingPresenter;
use Mezon\Tests\TestingView;

/**
 *
 * @psalm-suppress PropertyNotSetInConstructor
 */
class SetViewParameterUnitTest extends TestCase
{

    /**
     * Data provider for the test testSetViewParameter
     *
     * @return array
     */
    public function setViewParemeterDataProvider(): array
    {
        return [
            [
                new TestingView(new HtmlTemplate(__DIR__ . '/../Res/', 'index')),
                'val'
            ],
            [
                null,
                null
            ]
        ];
    }

    /**
     * Testing method setViewParameter
     *
     * @param
     *            ?ViewInterface View
     * @param mixed $var
     *            expected variable name
     * @dataProvider setViewParemeterDataProvider
     */
    public function testSetViewParameter(?ViewInterface $view, $var): void
    {
        // setup
        $presenter = new TestingPresenter($view);

        // test body
        $presenter->setViewParameter('var', 'val', true);

        // assertions
        $this->assertEquals($var, $presenter->getViewParameter('var'));
    }

    /**
     * Testing method setViewParameter with default parameters
     */
    public function testSetViewParameterDEfault(): void
    {
        // setup
        $presenter = new TestingPresenter(new TestingView(new TestingTemplate(__DIR__ . '/../Res/', 'index')));

        // test body
        $presenter->setViewParameter('var', 'val');

        // assertions
        $this->assertEquals('val', TestingTemplate::$publicVars['var']);
    }
}
