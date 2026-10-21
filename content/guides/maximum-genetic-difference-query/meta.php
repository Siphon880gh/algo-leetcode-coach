<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Genetic Difference Query: DFS with an add/remove trie',
    'leetcode' => 1938,
    'difficulty' => 'Hard',
    'summary' => 'Answer queries offline. DFS from the root, inserting each node\'s value into a binary trie with counts on entry and removing it on exit, so the trie holds exactly the root path. At node u, answer its queries with a max-XOR walk.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'dfs', 'bit-manipulation', 'leetcode'],
    'related_session' => 'maximum-genetic-difference-query',
];
