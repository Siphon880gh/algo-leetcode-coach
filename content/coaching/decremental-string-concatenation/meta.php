<?php
declare(strict_types=1);

return [
    'title' => 'Decremental String Concatenation: DP on ends, the right overlap',
    'leetcode' => 2746,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep every (first, last) state instead of a greedy choice, and overlap a string’s last letter with the next one’s first. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'decremental-string-concatenation',
    'tags' => ['array', 'string', 'dynamic-programming', 'step-by-step'],
];
