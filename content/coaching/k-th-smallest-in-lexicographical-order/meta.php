<?php
declare(strict_types=1);

return [
    'title' => 'K-th Smallest in Lexicographical Order: count a prefix subtree, skip or descend',
    'leetcode' => 440,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: the k-th number of [1, n] in dictionary order, n up to 1e9. Walk the 10-ary prefix tree without building it: count numbers under prefix cur; if k is past them, move to cur + 1, else step into cur × 10. n = 13, k = 2 → 10. Not 386. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'math', 'prefix-counting', 'step-by-step'],
    'related_guide' => 'k-th-smallest-in-lexicographical-order',
];
