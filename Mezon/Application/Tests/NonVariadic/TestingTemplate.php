<?php
namespace Mezon\Application\Tests\NonVariadic;

use Mezon\HtmlTemplate\HtmlTemplate;

/**
 * Template class for testing purposes
 *
 * @author Dodonov A.A.
 */
class TestingTemplate extends HtmlTemplate
{

    /**
     * Public vars
     *
     * @var mixed[]
     */
    public static $publicVars = [];

    /**
     * Setting page variables
     *
     * @param string $var
     *            variable name
     * @param mixed $value
     *            variable value
     */
    public function setPageVar(string $var, $value): void
    {
        static::$publicVars[$var] = $value;

        parent::setPageVar($var, $value);
    }
}
