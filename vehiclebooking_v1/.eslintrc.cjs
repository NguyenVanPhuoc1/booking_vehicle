/* eslint-env node */
module.exports = {
  env: {
    browser: true,
    es2021: true
  },
  extends: [
    'plugin:vue/vue3-essential',
    'eslint:recommended',
    '@vue/typescript/recommended'
  ],
  parserOptions: {
    ecmaVersion: 12,
    sourceType: 'module'
  },
  ignorePatterns: ['**/*.d.ts'],
  rules: {
    // Bạn có thể thêm các quy tắc tuỳ chỉnh ở đây
  }
};
