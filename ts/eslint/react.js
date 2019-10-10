/* eslint @typescript-eslint/no-var-requires: 'off' */
const base = require('./base');
const configs = require('./configs');

module.exports = {
  ...base,
  extends: configs.concat('airbnb', 'prettier/react'),
  plugins: base.plugins.concat('react-hooks'),
  rules: {
    ...base.rules,
    'jsx-a11y/interactive-supports-focus': 'off',
    'jsx-a11y/click-events-have-key-events': 'off',
    'jsx-a11y/label-has-associated-control': 'off',
    'jsx-a11y/label-has-for': [
      'error',
      {
        required: {
          every: ['id'],
        },
      },
    ],
    'react/destructuring-assignment': 'off',
    'react/jsx-boolean-value': 'off',
    'react/jsx-curly-brace-presence': [
      'error',
      { props: 'never', children: 'never' },
    ],
    'react/jsx-filename-extension': ['error', { extensions: ['.tsx'] }],
    'react/jsx-uses-vars': 'error',
    'react/no-danger': 'off',
    'react/no-unused-prop-types': 'off',
    'react/prop-types': 'off',
    'react/require-default-props': 'off',
  },
  settings: {
    ...base.settings,
    react: {
      version: 'detect',
    },
  },
};
