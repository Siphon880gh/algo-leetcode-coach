<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make the Array Increasing: raise to prev + 1',
    'leetcode' => 1827,
    'difficulty' => 'Easy',
    'summary' => 'Scan left to right keeping the required previous value; each element becomes max(itself, prev + 1) and costs the difference.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-the-array-increasing',
];
