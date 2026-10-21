<?php
declare(strict_types=1);

return [
    'title' => 'Find All Duplicates in an Array: values 1..n mark their own slot',
    'leetcode' => 442,
    'difficulty' => 'Med',
    'summary' => 'Values are in [1, n], each appears once or twice. Return the ones that appear twice in O(n) time, O(1) extra. Flip nums[|x| − 1] negative on first visit; already negative means x is a repeat. Or cycle-sort each value to index x − 1. [4,3,2,7,8,2,3,1] → [2,3]. Not 287 / 448.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['arrays', 'hash-table', 'leetcode'],
    'related_session' => 'find-all-duplicates-in-an-array',
];
