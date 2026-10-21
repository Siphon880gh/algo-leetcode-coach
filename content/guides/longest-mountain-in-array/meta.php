<?php
declare(strict_types=1);

return [
    'title' => 'Longest Mountain in Array: climb up, then down',
    'leetcode' => 845,
    'difficulty' => 'Med',
    'summary' => 'Scan once: from a base, count a strictly increasing run, then a strictly decreasing run. If both are non-empty, the mountain length is up + down + 1. Flat steps end a mountain.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'dynamic-programming', 'arrays', 'leetcode'],
    'related_session' => 'longest-mountain-in-array',
];
