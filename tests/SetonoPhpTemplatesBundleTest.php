<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle\Tests;

use Nyholm\BundleTest\BaseBundleTestCase;
use Nyholm\BundleTest\CompilerPass\PublicServicePass;
use Setono\PhpTemplates\Engine\Engine;
use Setono\PhpTemplatesBundle\SetonoPhpTemplatesBundle;

final class SetonoPhpTemplatesBundleTest extends BaseBundleTestCase
{
    protected function getBundleClass(): string
    {
        return SetonoPhpTemplatesBundle::class;
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->addCompilerPass(new PublicServicePass('|setono_php_templates.*|'));
    }

    /**
     * @test
     */
    public function init_bundle(): void
    {
        $this->bootKernel();

        $container = $this->getContainer();

        $this->assertTrue($container->has('setono_php_templates.engine.default'));
        $service = $container->get('setono_php_templates.engine.default');
        $this->assertInstanceOf(Engine::class, $service);
    }
}
