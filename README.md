# Wavevision Coding Standard


## Php

* rules for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)

### Installation
Via [Composer](https://getcomposer.org/)
```
composer require wavevision/coding-stadard
```
### Setup

Add to existing ruleset
```
<rule ref="vendor/wavevision/coding-standard/php/WavevisionCodingStandard/ruleset.xml"/>
```
or use directly
```
vendor/bin/phpcs <pathToSources> -p --standard=vendor/wavevision/coding-standard/php/WavevisionCodingStandard/ruleset.xml
```



