module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('@tailwindcss/nesting')(require('postcss-nesting')),
    require('autoprefixer'),
  ],
};
