const autoprefixer = require('autoprefixer');
const linter = require('postcss-bem-linter');
const reporter = require('postcss-reporter');

module.exports = {
  plugins: [autoprefixer, linter('bem'), reporter],
};
