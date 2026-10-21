<?php
declare(strict_types=1);

return [
    'title' => 'Transformable With Substring Sort: digit queues',
    'leetcode' => 1585,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: queue the positions of each digit in s; for each t char d, take the first position of d and require no smaller digit has an earlier pending position. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'check-if-string-is-transformable-with-substring-sort-operations',
    'tags' => ['greedy', 'queue', 'strings', 'step-by-step'],
];
