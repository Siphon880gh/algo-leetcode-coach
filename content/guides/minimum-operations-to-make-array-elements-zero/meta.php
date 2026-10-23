<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Array Elements Zero: total steps, halved',
    'leetcode' => 3495,
    'difficulty' => 'Hard',
    'summary' => 'A value v needs ⌊log₄ v⌋ + 1 divisions to reach 0. Each operation does two of them, so a query needs ⌈total / 2⌉; sum steps over the range by grouping values with the same step count.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'math', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-array-elements-zero',
];
