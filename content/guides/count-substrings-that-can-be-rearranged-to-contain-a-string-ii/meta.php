<?php
declare(strict_types=1);

return [
    'title' => 'Count Substrings That Can Be Rearranged to Contain a String II: linear covering window',
    'leetcode' => 3298,
    'difficulty' => 'Hard',
    'summary' => 'Same idea as part I: for each left end, the first covering right end. A count of still-missing letters keeps every step O(1), so the pass is linear in time with constant extra memory.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'sliding-window', 'leetcode'],
    'related_session' => 'count-substrings-that-can-be-rearranged-to-contain-a-string-ii',
];
