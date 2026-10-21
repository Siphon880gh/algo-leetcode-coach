<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Deletions to Make String Balanced: one-pass DP',
    'leetcode' => 1653,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right counting b\'s. On an a, either delete it (res + 1) or delete all b\'s before it (bCount); res = min of the two.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'stack', 'leetcode'],
    'related_session' => 'minimum-deletions-to-make-string-balanced',
];
