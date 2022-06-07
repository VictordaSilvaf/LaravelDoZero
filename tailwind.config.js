const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter var', ...defaultTheme.fontFamily.sans]
      },
      colors: {
        desicon: {
          orange: '#f39422',
          blue: '#007eb8',
          white: '#ffffff',
          natural5: '#C4C4C4',
          red: '#FF5630',
          yellow: '#FFA600',
          secondary: '#56CCF2',
          natural: '#6F767E',
          green: '#38CB89',
          secendary: '#D7F5E7',
          natural7: '#EFEFEF',
          bgContent: '#F5F6FA'
        }
      }
    }
  },
  variants: {
    extend: {
      backgroundColor: ['active']
    }
  },
  content: [
    './app/**/*.php',
    './resources/**/*.html',
    './resources/**/*.js',
    './resources/**/*.jsx',
    './resources/**/*.ts',
    './resources/**/*.tsx',
    './resources/**/*.php',
    './resources/**/*.vue',
    './resources/**/*.twig',
    './node_modules/flowbite/**/*.js'
  ],
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('flowbite/plugin')
  ]
}
