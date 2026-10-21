<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Points with Cost: left and right sweeps',
    'leetcode' => 1937,
    'difficulty' => 'Med',
    'summary' => 'Row DP: new[c] = row[c] + max over k of (prev[k] − |k − c|). Split |k − c| by side: a left-to-right sweep gives max(prev[k] − (c − k)) for k ≤ c, a right-to-left sweep for k ≥ c.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-number-of-points-with-cost',
];
