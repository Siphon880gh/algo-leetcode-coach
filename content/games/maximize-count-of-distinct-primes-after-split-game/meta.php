<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Count of Distinct Primes After Split',
    'leetcode' => 3569,
    'difficulty' => 'Hard',
    'summary' => 'A prime counts twice only if the split falls between its first and last occurrence. So the answer is (distinct primes) + max over k of (primes whose [first, last) range covers the split) — a segment tree with range add keeps that max under updates.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-count-of-distinct-primes-after-split',
    'related_session' => 'maximize-count-of-distinct-primes-after-split',
];
