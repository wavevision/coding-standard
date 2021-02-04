module.exports = {
  extends: ['airbnb', 'prettier/react'],
  plugins: ['react-hooks'],
  rules: {
    'jsx-a11y/click-events-have-key-events': 'off',
    'jsx-a11y/interactive-supports-focus': 'off',
    'jsx-a11y/label-has-associated-control': 'off',
    'jsx-a11y/label-has-for': ['error', { required: { every: ['id'] } }],
    'react/destructuring-assignment': 'off',
    'react/jsx-boolean-value': 'off',
    'react/jsx-curly-brace-presence': [
      'error',
      { props: 'never', children: 'never' },
    ],
    'react/jsx-filename-extension': ['error', { extensions: ['.tsx'] }],
    'react/jsx-props-no-spreading': [
      'error',
      { html: 'enforce', custom: 'ignore', explicitSpread: 'enforce' },
    ],
    'react/jsx-uses-vars': 'error',
    'react/no-danger': 'off',
    'react/no-unused-prop-types': 'off',
    'react/prop-types': 'off',
    'react/require-default-props': 'off',
    'react/state-in-constructor': 'off',
    'react/static-property-placement': ['error', 'static public field'],
  },
  settings: {
    react: { version: 'detect' },
  },
};
