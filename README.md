# PHP Templates Bundle

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
[![Coverage Status][ico-code-coverage]][link-code-coverage]
[![Quality Score][ico-code-quality]][link-code-quality]

This bundle integrates the [PHP templates library](https://github.com/Setono/php-templates) into Symfony.

## Installation

### Step 1: Download

```bash
$ composer require setono/php-templates-bundle
```

### Step 2: Enable the bundle

If you use Symfony Flex it will be enabled automatically. Else you need to add it to the `config/bundles.php`:

```php
<?php
// config/bundles.php

return [
    // ...
    Setono\PhpTemplatesBundle\SetonoPhpTemplatesBundle::class => ['all' => true],
    // ...
];
```

## Usage
### Service usage
The bundle registers the service `setono_php_templates.engine.default` and also autowires the interface
`Setono\PhpTemplates\Engine\EngineInterface` to that default engine. This means you can inject the engine just by
type hinting the interface:

```php
<?php
use Setono\PhpTemplates\Engine\EngineInterface;

final class YourService
{
    /** @var EngineInterface */
    private $engine;

    public function __construct(EngineInterface $engine) {
        $this->engine = $engine;
    }

    public function __invoke(): string
    {
        return $this->engine->render('YourNamespace/template', [
            'parameter' => 'value'
        ]);
    }
}
```

### Templates
The bundle automatically adds paths to the template engine. It is predefined to `src/Resources/views/php` for bundles
and `templates/php` for applications.

This means if you put templates (according the [correct structure](https://github.com/Setono/php-templates#usage)) you can use templates seamlessly as described in the
original [docs](https://github.com/Setono/php-templates).

[ico-version]: https://poser.pugx.org/setono/php-templates-bundle/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/php-templates-bundle/v/unstable
[ico-license]: https://poser.pugx.org/setono/php-templates-bundle/license
[ico-github-actions]: https://github.com/Setono/PhpTemplatesBundle/workflows/build/badge.svg
[ico-code-coverage]: https://img.shields.io/scrutinizer/coverage/g/Setono/PhpTemplatesBundle.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/PhpTemplatesBundle.svg

[link-packagist]: https://packagist.org/packages/setono/php-templates-bundle
[link-github-actions]: https://github.com/Setono/PhpTemplatesBundle/actions
[link-code-coverage]: https://scrutinizer-ci.com/g/Setono/PhpTemplatesBundle/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/PhpTemplatesBundle
