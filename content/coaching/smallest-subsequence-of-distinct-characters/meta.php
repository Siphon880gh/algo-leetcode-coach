<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Subsequence of Distinct Characters: greedy stack',
    'leetcode' => 1081,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: skip letters already in the stack, pop larger letters that occur again later, and push the current one. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'smallest-subsequence-of-distinct-characters',
    'tags' => ['stack', 'monotonic-stack', 'greedy', 'strings', 'step-by-step'],
];
