<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of People to Teach: fix only the broken friendships',
    'leetcode' => 1733,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: collect people in friendships that share no language; for each language count those who do not know it; answer the minimum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-number-of-people-to-teach',
    'tags' => ['greedy', 'hash-set', 'array', 'step-by-step'],
];
