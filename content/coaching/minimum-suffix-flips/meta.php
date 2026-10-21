<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Suffix Flips: count transitions',
    'leetcode' => 1529,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: start with state 0; each time the target bit differs from the state, flip (count + 1) and update the state. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-suffix-flips',
    'tags' => ['greedy', 'strings', 'step-by-step'],
];
