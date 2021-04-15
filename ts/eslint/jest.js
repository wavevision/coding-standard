module.exports = {
  env: {
    'jest/globals': true,
  },
  extends: ['plugin:jest/recommended', './base'],
  plugins: ['jest'],
  overrides: [
    {
      files: '*.test.*',
      rules: {
        '@typescript-eslint/ban-ts-comment': 'off',
        '@typescript-eslint/explicit-function-return-type': 'off',
      },
    },
  ],
  settings: {
    jest: { version: 'detect' },
  },
};
