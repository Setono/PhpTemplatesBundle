<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle\Tests\DependencyInjection\Compiler;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractCompilerPassTestCase;
use Setono\PhpTemplatesBundle\DependencyInjection\Compiler\AddPathsCompilerPass;
use Setono\PhpTemplatesBundle\Tests\Bundle\TestBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

final class AddPathsCompilerPassTest extends AbstractCompilerPassTestCase
{
    protected function registerCompilerPass(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new AddPathsCompilerPass());
    }

    /**
     * @test
     */
    public function it_adds_paths(): void
    {
        $this->setParameter('kernel.bundles', [
            'TestBundle' => TestBundle::class,
        ]);

        $this->setDefinition('setono_php_templates.engine.default', new Definition());

        $expectedPath = (new TestBundle())->getPath() . '/Resources/views/php';

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall('setono_php_templates.engine.default', 'addPath', [$expectedPath]);
    }
}
