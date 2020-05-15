# PHP Templates Bundle

[![Latest Version][ico-version]][link-packagist]
[![Latest Unstable Version][ico-unstable-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
[![Build Status][ico-github-actions]][link-github-actions]
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
TODO

[ico-version]: https://poser.pugx.org/setono/php-templates-bundle/v/stable
[ico-unstable-version]: https://poser.pugx.org/setono/php-templates-bundle/v/unstable
[ico-license]: https://poser.pugx.org/setono/php-templates-bundle/license
[ico-github-actions]: https://github.com/Setono/PhpTemplatesBundle/workflows/build/badge.svg
[ico-code-quality]: https://img.shields.io/scrutinizer/g/Setono/PhpTemplatesBundle.svg

[link-packagist]: https://packagist.org/packages/setono/php-templates-bundle
[link-github-actions]: https://github.com/Setono/PhpTemplatesBundle/actions
[link-code-quality]: https://scrutinizer-ci.com/g/Setono/PhpTemplatesBundle
