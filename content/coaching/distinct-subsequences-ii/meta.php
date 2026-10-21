<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Subsequences II: replace by last letter',
    'leetcode' => 940,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: track the number of distinct subsequences ending in each letter; reading c sets end[c] to (all distinct so far) + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'distinct-subsequences-ii',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
];
