var fs = require('fs');
var teal = require('teal-php');
var xtend = require('xtend');

module.exports = function(root, opts) {
  return teal(xtend(opts, {
    docroot: null,
    tlroot: root + '/site/tl',
    dest: root,
    tldest: 'site/templates',
    lib: root + '/site/plugins/teal/teal.php',
    mixin: fs.readFileSync(__dirname + '/mixin.php', 'utf8')
  }))
  .use(require('teal-tagify'));
};
