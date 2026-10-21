<?php
declare(strict_types=1);

return [
    'title' => 'Allocate Mailboxes: median cost + partition DP',
    'leetcode' => 1478,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort houses; cost[i][j] = distance sum to the median of i..j; dp over k contiguous groups. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'allocate-mailboxes',
    'tags' => ['dp', 'math', 'sorting', 'step-by-step'],
];
