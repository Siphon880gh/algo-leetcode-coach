<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Consecutive Subsequences: count and sum by last value',
    'leetcode' => 3299,
    'difficulty' => 'Hard',
    'summary' => 'For increasing chains: cntUp[x] += 1 + cntUp[x−1], sumUp[x] += x·(that count) + sumUp[x−1]. Same for decreasing with x+1. Singles appear in both, so subtract Σ nums once.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'sum-of-consecutive-subsequences',
    'related_session' => 'sum-of-consecutive-subsequences',
];
