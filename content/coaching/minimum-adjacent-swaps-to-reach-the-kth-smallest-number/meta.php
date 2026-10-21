<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Adjacent Swaps to Reach the Kth Smallest Number: target then bubble',
    'leetcode' => 1850,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: apply next permutation k times for the target, then bring each needed digit left from its nearest position. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-adjacent-swaps-to-reach-the-kth-smallest-number',
    'tags' => ['greedy', 'two-pointers', 'string', 'step-by-step'],
];
