<?php
declare(strict_types=1);

return [
    'title' => 'Valid Parenthesis String: a range of open counts',
    'leetcode' => 678,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track the lowest and highest possible open counts, fail when the high goes negative, clamp the low at 0, and finish at 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'valid-parenthesis-string',
    'tags' => ['greedy', 'strings', 'stack', 'step-by-step'],
];
