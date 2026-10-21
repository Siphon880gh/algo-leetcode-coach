<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Domino Rotations For Equal Row: try two candidates',
    'leetcode' => 1007,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the shared value must be tops[0] or bottoms[0]; for each candidate, check every domino has it and count the rotations needed for either row. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-domino-rotations-for-equal-row',
    'tags' => ['greedy', 'arrays', 'step-by-step'],
];
