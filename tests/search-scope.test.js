const assert = require('node:assert');
const fs = require('node:fs');

const functions = fs.readFileSync('functions.php', 'utf8');
const navigation = fs.readFileSync('template-parts/navigation.php', 'utf8');

assert.ok(functions.includes("$query->set('post_type', 'post')"));
assert.ok(navigation.includes('type="hidden" name="post_type" value="post"'));

console.log('Search is restricted to WordPress posts.');
