<?php

declare(strict_types=1);

namespace Croct\Ccl\Evaluation\PhpStan\Tests\Fixtures\ContextAcceptReturn;

use Antlr\Antlr4\Runtime\ParserRuleContext;
use Antlr\Antlr4\Runtime\Tree\TerminalNode;

class FooContext extends ParserRuleContext
{
    /**
     * @param int|null $index
     *
     * @return array<TerminalNode>|TerminalNode|null
     */
    public function subrule(?int $index = null)
    {
        if ($index === null) {
            return $this->getTokens(1);
        }

        return $this->getToken(1, $index);
    }

    public function ignore() : int
    {
        return 1;
    }

    public static function test() : void
    {
        $context = new FooContext(null);
        $children = $context->subrule();

        if (isset($children[0])) {
            $children[0]->getSymbol();
        }

        $symbol = $context->subrule(0);

        if ($symbol !== null) {
            $symbol->getSymbol();
        }

        $child = $context->getChild(1);

        if ($child !== null) {
            $child->getText();
        }
    }
}



