<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Count of Distinct Primes After Split: lazy segment tree over split points',
    'leetcode' => 3569,
    'difficulty' => 'Hard',
    'summary' => 'A prime counts twice exactly when the split k satisfies first < k ≤ last for its first and last positions. Keep sorted positions per prime; the answer is (distinct primes) + max over k of how many such ranges cover k, kept in a segment tree with range add and range max.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'math', 'number-theory', 'leetcode'],
    'related_session' => 'maximize-count-of-distinct-primes-after-split',
];
