<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle\Tests\DependencyInjection\Compiler;

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
        $projectDir = __DIR__ . '/../../App';

        $this->setParameter('kernel.bundles', [
            'TestBundle' => TestBundle::class,
        ]);
        $this->setParameter('kernel.project_dir', $projectDir);

        $this->setDefinition('setono_php_templates.engine.default', new Definition());

        $expectedBundlePath = (new TestBundle())->getPath() . '/Resources/views/php';
        $expectedProjectPath = $projectDir . '/templates/php';

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall('setono_php_templates.engine.default', 'addPath', [$expectedBundlePath]);
        $this->assertContainerBuilderHasServiceDefinitionWithMethodCall('setono_php_templates.engine.default', 'addPath', [$expectedProjectPath]);
    }

    /**
     * @test
     */
    public function it_does_not_add_path_if_bundle_is_not_an_instance_of_bundle_interface(): void
    {
        $this->setParameter('kernel.bundles', [
            'TestBundle' => get_class(new class() {
            }),
        ]);
        $this->setDefinition('setono_php_templates.engine.default', new Definition());

        $this->compile();

        $this->assertContainerBuilderHasServiceDefinitionWithoutMethodCall('setono_php_templates.engine.default', 'addPath');
    }
}
