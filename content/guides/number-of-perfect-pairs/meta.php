<?php
declare(strict_types=1);

return [
    'title' => 'Number of Perfect Pairs: compare absolute values',
    'leetcode' => 3649,
    'difficulty' => 'Med',
    'summary' => 'With x = |a| ≤ y = |b|, min(|a − b|, |a + b|) = y − x and max(...) = x + y. The second condition always holds and the first means y ≤ 2x, so count pairs whose larger absolute value is at most twice the smaller.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'number-of-perfect-pairs',
];
