const config = {
  open: false,
  proxy: 'http://glcandpartners.local',
  files: [
    'assets/*',
    'site/blueprints/**/*.yml',
    'site/controllers/*.php',
    'site/templates/*.php',
    'site/snippets/**/*.php',
    'content/**/*.txt',
    '*.html'
  ]
}

module.exports = config;
