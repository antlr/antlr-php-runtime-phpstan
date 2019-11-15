# ANTLR4 Extension for PHPStan

[![Travis CI](https://api.travis-ci.org/antlr/antlr-php-runtime-phpstan.svg?branch=master)](https://travis-ci.org/antlr/antlr-php-runtime-phpstan)
[![MIT License](https://img.shields.io/badge/license-BSD3-brightgreen.svg)](https://github.com/antlr/antlr-php-runtime-phpstan/blob/master/LICENSE)

Static analysis for [ANTLR4 PHP Runtime](https://github.com/antlr/antlr-php-runtime).

## Features

This extension provides correct return type for context's sub-rule getters.

## Install

Using Composer:

```sh
composer require --dev antlr/antlr-php-runtime-phpstan
```

## Register Plugin

If you also install [phpstan/extension-installer](https://github.com/phpstan/extension-installer) then you're all set!

<details>
  <summary>Manual installation</summary>

If you don't want to use `phpstan/extension-installer`, include extension.neon in your project's PHPStan config:

```yaml
includes:
    - vendor/antlr/antlr-php-runtime-phpstan/extension.neon
```
</details>

## Testing
To run all unit tests, use the locally installed PHPUnit:

```sh
./vendor/bin/phpunit
```

