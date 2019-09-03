module.exports = {
  extends: 'stylelint-config-sass-guidelines',
  plugins: ['stylelint-selector-bem-pattern'],
  rules: {
    'selector-class-pattern':
      '^(?:(?:o|c|u|t|s|is|has|_|js|qa)-)?[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*(?:__[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*)?(?:--[a-zA-Z0-9]+(?:-[a-zA-Z0-9]+)*)?(?:\\[.+\\])?$',
    'plugin/selector-bem-pattern': {
      componentName: '[a-z]+',
      componentSelectors: {
        initial: '^\\.{componentName}(?:-[a-z]+)?$',
        combined: '^\\.combined-{componentName}-[a-z]+$',
      },
      utilitySelectors: '^\\.util-[a-z]+$',
    },
    'max-nesting-depth': 2,
    'selector-max-compound-selectors': 4,
  },
};
