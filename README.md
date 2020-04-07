<p align="center"><a href="https://github.com/wavevision"><img alt="Wavevision s.r.o." src="https://wavevision.com/images/wavevision-logo.png" width="120" /></a></p>
<h1 align="center">Coding Standard</h1>

[![Build Status](https://travis-ci.org/wavevision/coding-standard.svg?branch=master)](https://travis-ci.org/wavevision/coding-standard)
[![Coverage Status](https://coveralls.io/repos/github/wavevision/coding-standard/badge.svg?branch=master)](https://coveralls.io/github/wavevision/coding-standard?branch=master)
[![PHPStan](https://img.shields.io/badge/style-level%20max-brightgreen.svg?label=phpstan)](https://github.com/phpstan/phpstan)
[![Release](https://img.shields.io/github/v/tag/wavevision/coding-standard?label=version&sort=semver)](https://github.com/wavevision/coding-standard/releases)
[![PHP version](https://img.shields.io/badge/php-7.4-blue)](https://www.php.net/releases/7_4_0.php)
[![TypeScript version](https://img.shields.io/badge/typescript-3.8-blue)](https://github.com/microsoft/TypeScript)

Code style rules and presets for [PHP](#php), [SCSS and TypeScript](#scss-and-typescript). Also contains default [PhpStorm](#phpstorm) project code style.

## PHP

Rules for:

- [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)

### Installation

Via [Composer](https://getcomposer.org/)

```bash
composer require --dev wavevision/coding-standard
```

### Setup

Add to existing ruleset

```xml
<rule ref="vendor/wavevision/coding-standard/php/WavevisionCodingStandard/ruleset.xml"/>
```

or use directly

```bash
vendor/bin/phpcs <pathToSources> -p --standard=vendor/wavevision/coding-standard/php/WavevisionCodingStandard/ruleset.xml
```

## SCSS and TypeScript

Rules and presets for:

- [babel](https://github.com/babel/babel)
- [eslint](https://github.com/eslint/eslint)
- [postcss](https://github.com/postcss/postcss)
- [prettier](https://github.com/prettier/prettier)
- [stylelint](https://github.com/stylelint/stylelint)
- [TypeScript](https://github.com/microsoft/TypeScript)

### Installation

Via [yarn](https://yarnpkg.com)

```bash
yarn add --dev @wavevision/coding-standard
```

or [npm](https://www.npmjs.com)

```bash
npm install --save-dev @wavevision/coding-standard
```

### Setup

Following config examples can be further extended and customized according to project's needs compliant with respective library docs.

#### `babel.config.js`

```javascript
module.exports = {
  presets: ['@wavevision/coding-standard/ts/babel'],
};
```

> **React version:** `@wavevision/coding-standard/ts/babel/react`.

#### `.eslintrc.js`

```javascript
module.exports = {
  extends: require.resolve('@wavevision/coding-standard/ts/eslint'),
  parserOptions: {
    project: 'tsconfig.json',
    tsconfigRootDir: '.',
  },
};
```

> **React version:** `@wavevision/coding-standard/ts/eslint/react`.

#### `postcss.config.js`

```javascript
module.exports = require('@wavevision/coding-standard/scss/postcss');
```

#### `prettier.config.js`

```javascript
module.exports = require('@wavevision/coding-standard/ts/prettier');
```

#### `stylelint.config.js`

```javascript
module.exports = {
  extends: '@wavevision/coding-standard/scss/stylelint',
};
```

#### `tsconfig.json`

```json
{
  "extends": "@wavevision/coding-standard/ts/tsconfig.json",
  "include": ["./src/**/*"]
}
```

#### Polyfills

Should your project need it, import `babel` polyfills consisting of `core-js` and `regenerator-runtime` stable versions.

```typescript
import '@wavevision/coding-standard/ts/polyfills';
```

> **Note:** This might add unnecessary code to your bundle. Make sure your setup needs all the polyfills, otherwise, import required features only.

This should most likely happen in your project's top-level entry point.

## PhpStorm

1. Set `File > Settings > Editor > CodeStyle` > Scheme to `Project`
2. Symlink `phpstorm/style.xml` to `.idea/codeStyles/Project.xml`
