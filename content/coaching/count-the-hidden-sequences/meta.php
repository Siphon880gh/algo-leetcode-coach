<?php
declare(strict_types=1);

return [
    'title' => 'Count the Hidden Sequences: slide a fixed shape',
    'leetcode' => 2145,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the prefix sums fix the shape, only the start moves, and the count is the slack plus one, floored at 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'count-the-hidden-sequences',
    'tags' => ['prefix-sum', 'array', 'step-by-step'],
];
