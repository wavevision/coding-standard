const presets = [
  ['@babel/preset-env', { corejs: 3, useBuiltIns: 'usage' }],
  '@babel/preset-typescript',
  '@babel/preset-react',
];
const plugins = [
  '@babel/plugin-proposal-class-properties',
  '@babel/plugin-proposal-object-rest-spread',
];

if (process.env.NODE_ENV === 'production') {
  plugins.concat([
    '@babel/plugin-transform-react-inline-elements',
    [
      '@babel/plugin-transform-react-constant-elements',
      { allowMutablePropsOnTags: ['FormattedMessage'] },
    ],
  ]);
}

module.exports = () => ({
  presets,
  plugins,
});
