/* eslint @typescript-eslint/no-var-requires: 'off' */
const configs = require('./configs');

const productionError =
  process.env.NODE_ENV === 'production' ? 'error' : 'warn';

module.exports = {
  env: {
    browser: true,
    node: true,
    'jest/globals': true,
  },
  extends: configs.concat('airbnb-base'),
  parser: '@typescript-eslint/parser',
  parserOptions: {
    ecmaVersion: 2018,
    sourceType: 'module',
    ecmaFeatures: {
      jsx: true,
      modules: true,
    },
  },
  plugins: ['@typescript-eslint', 'import', 'jest'],
  globals: {
    window: true,
    document: true,
  },
  rules: {
    '@typescript-eslint/explicit-function-return-type': [
      'error',
      { allowExpressions: true, allowTypedFunctionExpressions: true },
    ],
    '@typescript-eslint/explicit-member-accessibility': 'error',
    '@typescript-eslint/no-unused-vars': 'error',
    'arrow-parens': ['error', 'as-needed'],
    camelcase: 'off',
    'comma-dangle': 'off',
    'consistent-return': 'off',
    curly: ['error', 'multi-line'],
    'default-case': 'off',
    'guard-for-in': 'off',
    'import/no-extraneous-dependencies': 'off',
    'import/first': 'off',
    'import/order': [
      'error',
      {
        groups: [
          'builtin',
          'external',
          'internal',
          'parent',
          'sibling',
          'index',
        ],
        'newlines-between': 'always',
      },
    ],
    'import/prefer-default-export': 'off',
    'no-nested-ternary': 'off',
    'no-param-reassign': 'off',
    'no-plusplus': 'off',
    'no-restricted-syntax': 'off',
    'no-shadow': 'off',
    'no-underscore-dangle': 'off',
    'spaced-comment': 'off',
    'no-console': productionError,
    'no-debugger': productionError,
    'operator-linebreak': [
      'error',
      'after',
      { overrides: { '?': 'before', ':': 'before' } },
    ],
  },
  settings: {
    'import/resolver': {
      typescript: {},
    },
  },
};
