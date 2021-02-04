const presets = [
  ['@babel/preset-env', { corejs: 3, useBuiltIns: 'usage' }],
  '@babel/preset-typescript',
];

const plugins = [
  '@babel/plugin-proposal-class-properties',
  '@babel/plugin-proposal-object-rest-spread',
];

module.exports = () => ({
  presets,
  plugins,
});
