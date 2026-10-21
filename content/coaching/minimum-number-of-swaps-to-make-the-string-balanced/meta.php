<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Swaps to Make the String Balanced: worst deficit',
    'leetcode' => 1963,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track the maximum excess of ] over [ in any prefix; answer ceil(max / 2). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-number-of-swaps-to-make-the-string-balanced',
    'tags' => ['greedy', 'stack', 'string', 'step-by-step'],
];
