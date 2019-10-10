const presets = [
  ['@babel/preset-env', { corejs: 3, useBuiltIns: 'usage' }],
  '@babel/preset-typescript',
];
const plugins = [
  '@babel/plugin-proposal-class-properties',
  '@babel/plugin-proposal-object-rest-spread',
];

exports.presets = presets;
exports.plugins = plugins;

module.exports = () => ({
  presets,
  plugins,
});
