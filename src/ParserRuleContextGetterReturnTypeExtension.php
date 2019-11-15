<?php

declare(strict_types=1);

namespace Antlr\Antlr4\Runtime\PhpStan;

use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\ArrayType;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\IntegerType;
use PHPStan\Type\NullType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;
use PHPStan\Type\TypeCombinator;
use PHPStan\Type\UnionType;

class ParserRuleContextGetterReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    public function isMethodSupported(MethodReflection $methodReflection) : bool
    {
        return true;
    }

    public function getClass() : string
    {
        return 'Antlr\Antlr4\Runtime\ParserRuleContext';
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ) : Type {
        $type = $this->resolveType($methodReflection);

        if ($type === null) {
            return ParametersAcceptorSelector::selectSingle($methodReflection->getVariants())->getReturnType();
        }

        if (\count($methodCall->args) === 1) {
            return TypeCombinator::addNull($type);
        }

        return new ArrayType(new IntegerType(), $type);
    }

    private function resolveType(MethodReflection $methodReflection) : ?ObjectType
    {
        $declaringClass = $methodReflection->getDeclaringClass();

        if ($declaringClass->getName() === $this->getClass()) {
            return null;
        }

        foreach ($methodReflection->getVariants() as $variant) {
            if (\count($variant->getParameters()) !== 1) {
                continue;
            }

            $returnType = $variant->getReturnType();

            if (!$returnType instanceof UnionType || !TypeCombinator::containsNull($returnType)) {
                continue;
            }

            $types = $returnType->getTypes();

            if (\count($types) !== 3) {
                continue;
            }

            foreach ($types as $current) {
                if ($current instanceof NullType) {
                    continue;
                }

                if ($current instanceof ObjectType) {
                    return $current;
                }
            }
        }

        return null;
    }
}
