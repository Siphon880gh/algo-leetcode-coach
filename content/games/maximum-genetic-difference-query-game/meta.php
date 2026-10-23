<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Genetic Difference Query',
    'leetcode' => 1938,
    'difficulty' => 'Hard',
    'summary' => 'DFS from the root, inserting each node\'s value into a binary trie on entry and removing it on exit. At node u, the trie holds exactly its path to the root; answer its queries by greedy opposite-bit walks.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-genetic-difference-query',
    'related_session' => 'maximum-genetic-difference-query',
];
