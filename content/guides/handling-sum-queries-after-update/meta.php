<?php
declare(strict_types=1);

return [
    'title' => 'Handling Sum Queries After Update: count the ones with a lazy flip tree',
    'leetcode' => 2569,
    'difficulty' => 'Hard',
    'summary' => 'A type 2 query adds p times the number of 1s in nums1 to the total of nums2, so only that count matters. Keep it in a segment tree whose lazy tag flips a range: the new count is the length minus the old count.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['array', 'segment-tree', 'leetcode'],
    'related_session' => 'handling-sum-queries-after-update',
];
