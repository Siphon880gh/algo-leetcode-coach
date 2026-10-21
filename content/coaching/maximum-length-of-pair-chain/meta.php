<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Pair Chain: earliest end first',
    'leetcode' => 646,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort by the end value, take each pair that starts strictly after the last chosen end, and trust the exchange argument. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-length-of-pair-chain',
    'tags' => ['greedy', 'sorting', 'dynamic-programming', 'step-by-step'],
];
