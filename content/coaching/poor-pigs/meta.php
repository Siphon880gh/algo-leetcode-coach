<?php
declare(strict_types=1);

return [
    'title' => 'Poor Pigs: each pig has rounds + 1 outcomes, so pigs are digits',
    'leetcode' => 458,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fewest pigs to find one poisoned bucket in time. With t = minutesToTest / minutesToDie rounds, each pig ends in t + 1 states, so p pigs separate (t + 1)^p buckets. Return the smallest p with (t + 1)^p ≥ buckets. 4, 15, 15 → 2. 1000, 15, 60 → 5. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'combinatorics', 'step-by-step'],
    'related_guide' => 'poor-pigs',
];
