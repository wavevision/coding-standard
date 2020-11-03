#!/bin/bash
#
# Lint ruleset XML file.
#
# BASH-VERSION  :4.2+
# DEPENDS       :apt-get install wget libxml2-utils

RULESET="php/WavevisionCodingStandard/ruleset.xml"

set -e

# Current directory should be repository root
test -r "$RULESET"

# Check dependency
hash xmllint

# Create temporary directory
mkdir -p temp

# Download XML schema definitions
wget -nv -N -P temp/ "https://github.com/squizlabs/PHP_CodeSniffer/raw/master/phpcs.xsd"
wget -nv -N -P temp/ "https://www.w3.org/2012/04/XMLSchema.xsd"

xmllint --noout --schema temp/XMLSchema.xsd temp/phpcs.xsd
xmllint --noout --schema temp/phpcs.xsd "$RULESET"
diff -B "$RULESET" <(XMLLINT_INDENT="	" xmllint --format "$RULESET")
