module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  theme: {
    extend: {
      fontFamily: {
        'raleway-light': ['Raleway'],
      },
      colors: {
        mainblue: {
          600: '#0061BB',
        },
      },
    },
  },
  plugins: [],
};
