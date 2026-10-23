<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Subarrays: owner of each subarray',
    'leetcode' => 3878,
    'difficulty' => 'Hard',
    'summary' => 'A subarray is good when one element contains every bit of the others. Credit it to the last such element: from i, extend left while values are submasks and not equal to nums[i], and right while values are submasks. Track the nearest blocking index per bit.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['stack', 'bit-manipulation', 'array', 'monotonic-stack', 'leetcode'],
    'related_session' => 'count-good-subarrays',
];
