<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;

final class AddPathsCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('setono_php_templates.engine.default')) {
            return;
        }

        $engine = $container->getDefinition('setono_php_templates.engine.default');

        if ($container->hasParameter('kernel.bundles')) {
            self::addBundlePaths($container->getParameter('kernel.bundles'), $engine);
        }

        if ($container->hasParameter('kernel.project_dir')) {
            self::addProjectPath($container->getParameter('kernel.project_dir'), $engine);
        }
    }

    private static function addBundlePaths(array $bundles, Definition $engine): void
    {
        foreach ($bundles as $bundleName => $bundleClass) {
            $bundle = new $bundleClass();
            if (!$bundle instanceof BundleInterface) {
                continue;
            }

            $phpTemplatesPath = $bundle->getPath() . '/Resources/views/php';

            if (!is_dir($phpTemplatesPath) || !is_readable($phpTemplatesPath)) {
                continue;
            }

            $engine->addMethodCall('addPath', [$phpTemplatesPath]);
        }
    }

    private static function addProjectPath(string $projectDir, Definition $engine): void
    {
        $phpTemplatesPath = $projectDir . '/templates/php';

        if (!is_dir($phpTemplatesPath) || !is_readable($phpTemplatesPath)) {
            return;
        }

        $engine->addMethodCall('addPath', [$phpTemplatesPath]);
    }
}
