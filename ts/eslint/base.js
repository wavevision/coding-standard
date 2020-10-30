const productionError =
  process.env.NODE_ENV === 'production' ? 'error' : 'warn';

module.exports = {
  env: {
    browser: true,
    node: true,
    'jest/globals': true,
  },
  extends: [
    'plugin:@typescript-eslint/recommended',
    'plugin:import/typescript',
    'plugin:jest/recommended',
    'plugin:prettier/recommended',
    'prettier',
    'prettier/@typescript-eslint',
  ],
  parser: '@typescript-eslint/parser',
  parserOptions: {
    ecmaVersion: 2020,
    sourceType: 'module',
    ecmaFeatures: {
      jsx: true,
      modules: true,
    },
  },
  plugins: ['@typescript-eslint', 'import', 'jest', 'prettier'],
  globals: {
    window: true,
    document: true,
  },
  rules: {
    '@typescript-eslint/explicit-function-return-type': [
      'error',
      {
        allowExpressions: true,
        allowHigherOrderFunctions: true,
        allowTypedFunctionExpressions: true,
      },
    ],
    '@typescript-eslint/explicit-member-accessibility': 'error',
    '@typescript-eslint/no-unused-vars': [
      'error',
      { ignoreRestSiblings: true },
    ],
    '@typescript-eslint/no-use-before-define': 'error',
    'arrow-parens': ['error', 'as-needed'],
    camelcase: 'off',
    'comma-dangle': 'off',
    'consistent-return': 'off',
    curly: ['error', 'multi-line'],
    'default-case': 'off',
    'function-paren-newline': 'off',
    'guard-for-in': 'off',
    'implicit-arrow-linebreak': 'off',
    'import/extensions': [
      'error',
      'ignorePackages',
      {
        js: 'never',
        mjs: 'never',
        jsx: 'never',
        ts: 'never',
        tsx: 'never',
      },
    ],
    'import/first': 'off',
    'import/no-extraneous-dependencies': 'off',
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
    'no-confusing-arrow': 'off',
    'no-console': productionError,
    'no-debugger': productionError,
    'no-nested-ternary': 'off',
    'no-param-reassign': 'off',
    'no-plusplus': 'off',
    'no-restricted-syntax': 'off',
    'no-shadow': 'off',
    'no-underscore-dangle': 'off',
    'no-use-before-define': 'off',
    'object-curly-newline': ['error', { consistent: true }],
    'operator-linebreak': [
      'error',
      'after',
      {
        overrides: {
          '?': 'before',
          ':': 'before',
        },
      },
    ],
    'spaced-comment': 'off',
  },
  overrides: [
    {
      files: '*.test.*',
      rules: {
        '@typescript-eslint/ban-ts-ignore': 'off',
        '@typescript-eslint/explicit-function-return-type': 'off',
      },
    },
  ],
  settings: {
    'import/extensions': ['.js', '.mjs', '.jsx', '.ts', '.tsx'],
    'import/resolver': {
      typescript: {},
    },
    jest: { version: 'detect' },
  },
};
