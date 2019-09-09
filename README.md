# Wavevision Coding Standard

[![Build Status](https://travis-ci.org/wavevision/coding-standard.svg?branch=master)](https://travis-ci.org/wavevision/coding-standard)
[![Coverage Status](https://coveralls.io/repos/github/wavevision/coding-standard/badge.svg?branch=master)](https://coveralls.io/github/wavevision/coding-standard?branch=master)
![PHPStan](https://img.shields.io/badge/style-level%20max-brightgreen.svg?label=phpstan)

Code style rules and presets for [Php](#php), [SCSS and TypeScript](#scss-and-typescript). Also contains default [PhpStorm](#phpstorm) project code style.

**Requirements:**

- Php 7.2
- Node.js 10.16.0

## Php

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

#### `eslintrc.js`

```javascript
module.exports = {
  extends: require.resolve('@wavevision/coding-standard/ts/eslint'),
};
```

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
  "extends": "@wavevision/coding-standard/ts/tsconfig.json"
}
```

#### Polyfills

Do not forget to import base polyfills that are critical for `babel` to compile your code correctly.

```typescript
import '@wavevision/coding-standard/ts/polyfills';
```

This should most likely happen in your project's top-level entry point.

## PhpStorm

1. Set `File > Settings > Editor > CodeStyle` > Scheme to `Project`
2. Symlink `phpstorm/style.xml` to `.idea/codeStyles/Project.xml`
