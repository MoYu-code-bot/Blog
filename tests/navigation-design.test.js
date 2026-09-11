const assert = require('node:assert');
const fs = require('node:fs');

const navigation = fs.readFileSync('template-parts/navigation.php', 'utf8');
const css = fs.readFileSync('style.css', 'utf8');
const functions = fs.readFileSync('functions.php', 'utf8');
const interaction = fs.readFileSync('assets/js/navigation.js', 'utf8');

for (const label of ['分类', '社区', '技术笔记', 'AI 探索', '建站记录', '生活随笔']) {
    assert.ok(navigation.includes(label), `Missing navigation label: ${label}`);
}
assert.ok(!navigation.includes("add_query_arg(['s'"));
assert.ok(!navigation.includes('>归档<'));
assert.ok(!navigation.includes('>灵感<'));
assert.ok(navigation.includes('<details>'));
assert.ok(css.includes('.moyu-mega-menu.moyu-glass'));
assert.ok(css.includes('width: min(590px, 64vw)'));
assert.ok(css.includes('background: rgba(7, 15, 27, .88)'));
assert.ok(functions.includes("'community' =>"));
assert.ok(functions.includes("'_wp_page_template', 'page-content-hub.php'"));
assert.ok(interaction.includes("event.key === 'Escape'"));
assert.ok(interaction.includes('!menu.contains(event.target)'));

console.log('FB navigation structure is present.');
