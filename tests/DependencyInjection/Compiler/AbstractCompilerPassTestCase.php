<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle\Tests\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase as BaseAbstractCompilerPassTestCase;

abstract class AbstractCompilerPassTestCase extends BaseAbstractCompilerPassTestCase
{
    protected function assertContainerBuilderHasServiceDefinitionWithoutMethodCall(string $serviceId, string $method): void
    {
        $definition = $this->container->findDefinition($serviceId);

        self::assertThat($definition, new DefinitionDoesNotHaveMethodCallConstraint($method));
    }
}
