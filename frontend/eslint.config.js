import globals from "globals";
import pluginJs from "@eslint/js";
import pluginReactConfig from "eslint-plugin-react/configs/recommended.js";
import reactHooks from 'eslint-plugin-react-hooks';
import reactRefresh from 'eslint-plugin-react-refresh';

export default [
  { files: ["**/*.{js,mjs,cjs,jsx}"] },
  {
    files: ["eslint.config.js", "vite.config.js"],
    languageOptions: { globals: globals.node },
  },
  {
    languageOptions: { globals: globals.browser },
  },
  pluginJs.configs.recommended,
  pluginReactConfig,
  {
    settings: {
      react: {
        version: "detect"
      }
    }
  },
  {
    files: ["**/*.jsx"],
    plugins: {
      'react-hooks': reactHooks,
      'react-refresh': reactRefresh
    },
    rules: {
      ...reactHooks.configs.recommended.rules,
      'react-refresh/only-export-components': [
        'warn',
        { allowConstantExport: true },
      ],
      'react/prop-types': 'off',
      'react/react-in-jsx-scope': 'off'
    }
  }
];
