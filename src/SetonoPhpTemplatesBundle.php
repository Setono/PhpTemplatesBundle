<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle;

use Setono\PhpTemplatesBundle\DependencyInjection\Compiler\AddPathsCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SetonoPhpTemplatesBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $container->addCompilerPass(new AddPathsCompilerPass());
    }
}
