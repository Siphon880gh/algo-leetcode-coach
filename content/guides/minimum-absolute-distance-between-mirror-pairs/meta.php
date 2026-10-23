<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Absolute Distance Between Mirror Pairs: last index of each reverse',
    'leetcode' => 3761,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right, storing reverse(nums[i]) → latest i. At j, a match on nums[j] gives a pair ending at j, and the latest i is the closest.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'leetcode'],
    'related_session' => 'minimum-absolute-distance-between-mirror-pairs',
];
