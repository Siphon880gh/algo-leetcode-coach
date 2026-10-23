<?php
declare(strict_types=1);

return [
    'title' => 'Good Subsequence Queries: gcd of the multiples of p',
    'leetcode' => 3901,
    'difficulty' => 'Hard',
    'summary' => 'Only multiples of p can be in a good subsequence, so keep a segment tree with the gcd of multiples of p (others stored as 0). If that gcd is p and some element is not a multiple, the multiples alone work.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'math', 'number-theory', 'leetcode'],
    'related_session' => 'good-subsequence-queries',
];
