<?php
declare(strict_types=1);

return [
    'title' => 'Power of Heroes: sort, each value as the maximum',
    'leetcode' => 2681,
    'difficulty' => 'Hard',
    'summary' => 'After sorting, let x be a group’s maximum. The groups with maximum x and minimum a[j] number 2^(i−j−1), so keep p = Σ a[j] · 2^(i−j−1) and add x² · (x + p).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'prefix-sum', 'sorting', 'leetcode'],
    'related_session' => 'power-of-heroes',
];
