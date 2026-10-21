<?php
declare(strict_types=1);

return [
    'title' => 'Merge Triplets to Form Target Triplet: merge only safe triplets',
    'leetcode' => 1899,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: ignore triplets exceeding the target anywhere, take the elementwise max of the rest, compare with the target. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'merge-triplets-to-form-target-triplet',
    'tags' => ['greedy', 'array', 'step-by-step'],
];
