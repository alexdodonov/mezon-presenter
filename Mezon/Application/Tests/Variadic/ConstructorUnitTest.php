<?php
namespace Mezon\Application\Tests\Variadic;

use PHPUnit\Framework\TestCase;
use Mezon\Application\VariadicPresenter;
use Mezon\Conf\Conf;
use Mezon\Application\Presenter;
use Mezon\Application\Tests\TestingPresenter;

/**
 * 
 * @psalm-suppress PropertyNotSetInConstructor
 */
class ConstructorUnitTest extends TestCase
{

    /**
     * Testing data provider
     *
     * @return array testing data
     */
    public function constructorDataProvider(): array
    {
        return [
            [ // #0, preconstructed presenter was passed
                function (): object {
                    // setup method
                    Conf::setConfigValue('testing-variadic-presenter', 'local');

                    return new TestingVariadicPresenter(null, '', null, new TestingPresenter());
                },
                function (VariadicPresenter $presenter): void {
                    // asserting method
                    $this->assertInstanceOf(TestingPresenter::class, $presenter->getRealPresenter());
                }
            ],
            [ // #1, local presenter is used
                function (): object {
                    // setup method
                    Conf::setConfigValue('testing-variadic-presenter', 'local');

                    return new TestingVariadicPresenter();
                },
                function (VariadicPresenter $presenter): void {
                    // asserting method
                    $this->assertInstanceOf(Presenter::class, $presenter->getRealPresenter());
                }
            ],
            [ // #2, remote presenter is used
                function (): object {
                    // setup method
                    Conf::setConfigValue('testing-variadic-presenter', 'remote');

                    return new TestingVariadicPresenter();
                },
                function (VariadicPresenter $presenter): void {
                    // asserting method
                    $this->assertInstanceOf(TestingPresenter::class, $presenter->getRealPresenter());
                }
            ],
            [ // #3, precreated presenter from config
                function (): object {
                    // setup method
                    Conf::setConfigValue('testing-variadic-presenter', new TestingPresenter());

                    return new TestingVariadicPresenter();
                },
                function (VariadicPresenter $presenter): void {
                    // asserting method
                    $this->assertInstanceOf(TestingPresenter::class, $presenter->getRealPresenter());
                }
            ]
        ];
    }

    /**
     * Testing constructor
     *
     * @param callable $setup
     *            setup method
     * @param callable $assertions
     *            assertions method
     * @dataProvider constructorDataProvider
     */
    public function testConstructor(callable $setup, callable $assertions): void
    {
        // setup and test body
        $presenter = $setup();

        // assertions
        $assertions($presenter);
    }

    /**
     * Testing exception when unexpected presenter type was passed
     */
    public function testExceptionForUnexpectedPresenterType(): void
    {
        // assertions
        $this->expectException(\Exception::class);

        // setup
        Conf::setConfigValue('variadic-presenter-config-key', \stdClass::class);

        // test body
        new VariadicPresenter();
    }
}
