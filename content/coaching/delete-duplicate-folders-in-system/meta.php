<?php
declare(strict_types=1);

return [
    'title' => 'Delete Duplicate Folders in System: canonical subtree strings',
    'leetcode' => 1948,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: build a trie, serialise each non-empty subtree with sorted children, count, then output folders whose signature is unique. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'delete-duplicate-folders-in-system',
    'tags' => ['trie', 'hash-table', 'string', 'dfs', 'step-by-step'],
];
