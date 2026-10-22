<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Matching of Players With Trainers: skip weak trainers, ≤, one player each',
    'leetcode' => 2410,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: skip a trainer that cannot take the weakest player, match when ability is at most capacity, and give each trainer one player. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-matching-of-players-with-trainers',
    'tags' => ['array', 'two-pointers', 'greedy', 'sorting', 'step-by-step'],
];
