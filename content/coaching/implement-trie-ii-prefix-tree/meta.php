<?php
declare(strict_types=1);

return [
    'title' => 'Implement Trie II (Prefix Tree): counts on every node',
    'leetcode' => 1804,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each trie node keeps a pass count and an end count; insert and erase adjust both along the path; the queries read them at the last node (0 if the path is missing). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'implement-trie-ii-prefix-tree',
    'tags' => ['trie', 'design', 'hash-table', 'step-by-step'],
];
