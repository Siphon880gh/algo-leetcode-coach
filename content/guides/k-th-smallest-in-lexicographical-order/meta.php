<?php
declare(strict_types=1);

return [
    'title' => 'K-th Smallest in Lexicographical Order: count a prefix subtree, skip or descend',
    'leetcode' => 440,
    'difficulty' => 'Hard',
    'summary' => 'Find the k-th number in [1, n] in dictionary order with n up to 1e9. Treat numbers as a 10-ary prefix tree. Count how many numbers in [1, n] start with prefix cur, level by level. If k is past that subtree, skip to cur + 1; else step into cur × 10. n = 13, k = 2 → 10. Not 386 (list them all).',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['trie', 'math', 'prefix-counting', 'leetcode'],
    'related_session' => 'k-th-smallest-in-lexicographical-order',
];
