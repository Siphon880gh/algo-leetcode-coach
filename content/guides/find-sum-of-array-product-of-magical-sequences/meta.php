<?php
declare(strict_types=1);

return [
    'title' => 'Find Sum of Array Product of Magical Sequences: counts with carries',
    'leetcode' => 3539,
    'difficulty' => 'Hard',
    'summary' => 'Only how many times each index is used matters. Choose a count c for each index from low to high; c copies of 2^i plus the carry from below fix bit i and pass the rest up. Weight each choice by nums[i]^c / c! and multiply by m! at the end to count orderings.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'math', 'dynamic-programming', 'bitmask', 'combinatorics', 'leetcode'],
    'related_session' => 'find-sum-of-array-product-of-magical-sequences',
];
