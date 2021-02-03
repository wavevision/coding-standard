const plugins = [];
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
  presets: ['@babel/preset-react'],
  plugins,
});
