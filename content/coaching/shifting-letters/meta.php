<?php
declare(strict_types=1);

return [
    'title' => 'Shifting Letters: suffix sums from the right',
    'leetcode' => 848,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: letter i moves by shifts[i] + … + shifts[n − 1], so sweep from the right with a running total taken mod 26. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'shifting-letters',
    'tags' => ['prefix-sum', 'strings', 'step-by-step'],
];
