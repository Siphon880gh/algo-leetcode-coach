<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Rounds to Complete All Tasks: ceil of count over three',
    'leetcode' => 2244,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: reject a count of 1, use ⌈c / 3⌉ for every other count, and add the rounds across difficulties. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-rounds-to-complete-all-tasks',
    'tags' => ['array', 'hash-table', 'greedy', 'counting', 'step-by-step'],
];
