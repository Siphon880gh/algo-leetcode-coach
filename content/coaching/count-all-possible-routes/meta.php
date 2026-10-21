<?php
declare(strict_types=1);

return [
    'title' => 'Count All Possible Routes: memo on (city, fuel)',
    'leetcode' => 1575,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: ways(i, fuel) = [i == finish] + Σ ways(j, fuel − |loc[i] − loc[j]|) over j ≠ i with enough fuel; memoise mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'count-all-possible-routes',
    'tags' => ['dp', 'memoization', 'step-by-step'],
];
