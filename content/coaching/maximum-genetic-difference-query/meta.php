<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Genetic Difference Query: path-only trie',
    'leetcode' => 1938,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: DFS inserting each node into a counted trie on entry and removing on exit; answer queries at their node with a max-XOR walk. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'maximum-genetic-difference-query',
    'tags' => ['trie', 'dfs', 'bit-manipulation', 'step-by-step'],
];
