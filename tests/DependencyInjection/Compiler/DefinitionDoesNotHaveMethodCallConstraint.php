<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle\Tests\DependencyInjection\Compiler;

use InvalidArgumentException;
use PHPUnit\Framework\Constraint\Constraint;
use Symfony\Component\DependencyInjection\Definition;

final class DefinitionDoesNotHaveMethodCallConstraint extends Constraint
{
    /** @var string */
    private $methodName;

    public function __construct(string $methodName)
    {
        $this->methodName = $methodName;
    }

    public function evaluate($other, string $description = '', bool $returnResult = false): bool
    {
        if (!$other instanceof Definition) {
            throw new InvalidArgumentException(
                'Expected an instance of Symfony\Component\DependencyInjection\Definition'
            );
        }

        $methodCalls = $other->getMethodCalls();

        $hasMethodCall = false;

        foreach ($methodCalls as [$method]) {
            if ($method === $this->methodName) {
                $hasMethodCall = true;
            }
        }

        if (!$hasMethodCall) {
            return true;
        }

        if (!$returnResult) {
            $this->fail($other, sprintf('The method call, "%s" was made', $this->methodName));
        }

        return false;
    }

    public function toString(): string
    {
        return sprintf('does not have a method call to "%s"', $this->methodName);
    }
}
