const imports = require('postcss-import');
// const tailwindcss = require('tailwindcss');
// const purgecss = require('@fullhuman/postcss-purgecss');
const cssnano = require('cssnano');
const autoprefixer = require('autoprefixer');
const nested = require('postcss-nested');
const customProperties = require('postcss-custom-properties');

module.exports = {
  plugins: [
    // ...
    imports,
    autoprefixer,
    customProperties,
    nested,
    cssnano({
      preset: 'default',
    }),
    // purgecss({
    //   content: [
    //     'index.php'
    //   ],
    //   whitelist: ['bg-gray-300']
    // }),
    // ...
  ]
}

// const purgecss = require('@fullhuman/postcss-purgecss')({
//
//   // Specify the paths to all of the template files in your project
//   content: [
//     './src/**/*.html',
//     './src/**/*.vue',
//     './src/**/*.jsx',
//     // etc.
//   ],
//
//   // Include any special characters you're using in this regular expression
//   defaultExtractor: content => content.match(/[A-Za-z0-9-_:/]+/g) || []
// })
//
// module.exports = {
//   plugins: [
//     require('postcss-import'),
//     require('tailwindcss'),
//     require('postcss-nested'),
//     require('postcss-custom-properties'),
//     require('autoprefixer'),
//     ...process.env.NODE_ENV === 'production'
//       ? [purgecss]
//       : []
//   ]
// }
