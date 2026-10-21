<?php
declare(strict_types=1);

return [
    'title' => 'Find in Mountain Array: three binary searches',
    'leetcode' => 1095,
    'difficulty' => 'Hard',
    'summary' => 'Find the peak by comparing neighbours, then binary search the rising side for target, and only if it is missing there, the falling side with the comparison reversed. That stays within the 100-call budget.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'interactive', 'arrays', 'leetcode'],
    'related_session' => 'find-in-mountain-array',
];
