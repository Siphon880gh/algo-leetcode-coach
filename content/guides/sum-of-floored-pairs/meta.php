<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Floored Pairs: counting with prefix sums over multiples',
    'leetcode' => 1862,
    'difficulty' => 'Hard',
    'summary' => 'For each distinct divisor y and each k, the values x in [k·y, (k + 1)·y − 1] contribute k each. A prefix count array gives how many there are; the harmonic sum makes this O(M log M).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'prefix-sum', 'binary-search', 'leetcode'],
    'related_session' => 'sum-of-floored-pairs',
];
