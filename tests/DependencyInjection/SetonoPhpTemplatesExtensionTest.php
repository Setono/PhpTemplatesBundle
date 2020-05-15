<?php

declare(strict_types=1);

namespace Setono\PhpTemplatesBundle\Tests\DependencyInjection;

use Matthias\SymfonyDependencyInjectionTest\PhpUnit\AbstractExtensionTestCase;
use Setono\PhpTemplatesBundle\DependencyInjection\SetonoPhpTemplatesExtension;

final class SetonoPhpTemplatesExtensionTest extends AbstractExtensionTestCase
{
    protected function getContainerExtensions(): array
    {
        return [
            new SetonoPhpTemplatesExtension(),
        ];
    }

    /**
     * @test
     */
    public function it_can_load(): void
    {
        $this->load();

        $this->assertTrue(true);
    }
}
