<?php
declare(strict_types=1);

return [
    'title' => 'Good Subsequence Queries',
    'leetcode' => 3901,
    'difficulty' => 'Hard',
    'summary' => 'Only multiples of p can be used. If some but not all elements are multiples and their gcd is p, the answer is yes. If all n are multiples, a proper subset with gcd p exists iff dropping one element leaves gcd p (prefix/suffix gcds; a segment tree keeps them under updates).',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'good-subsequence-queries',
    'related_session' => 'good-subsequence-queries',
];
