<?php
declare(strict_types=1);

return [
    'title' => 'Find Sum of Array Product of Magical Sequences: counts with carries',
    'leetcode' => 3539,
    'difficulty' => 'Hard',
    'summary' => 'Only how many times each index is used matters. Choose a count c for each index from low to high; c copies of 2^i plus the carry from below fix bit i and pass the rest up. Weight each choice by nums[i]^c / c! and multiply by m! at the end t',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['mini-game', 'leetcode', 'dynamic-programming'],
    'entry' => 'index.html',
    'related_guide' => 'find-sum-of-array-product-of-magical-sequences',
    'related_session' => 'find-sum-of-array-product-of-magical-sequences',
];
