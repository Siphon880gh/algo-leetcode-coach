<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Convert All Elements to Zero: monotonic stack',
    'leetcode' => 3542,
    'difficulty' => 'Med',
    'summary' => 'An operation on a value can cover every occurrence that is not separated by a smaller value (zeros included). Scan with an increasing stack: pop larger values, and count a new operation whenever a positive value is pushed that is not already on top.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'greedy', 'array', 'hash-table', 'monotonic-stack', 'leetcode'],
    'related_session' => 'minimum-operations-to-convert-all-elements-to-zero',
];
