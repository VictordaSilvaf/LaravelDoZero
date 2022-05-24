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
          white: '#ffffff'
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
    './resources/**/*.twig'
  ],
  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')]
}
