<?php
declare(strict_types=1);

return [
    'title' => 'Most Frequent IDs: counts plus a lazy max-heap',
    'leetcode' => 3092,
    'difficulty' => 'Med',
    'summary' => 'Keep each ID’s count in a hash map and push (count, ID) into a max-heap after every step. Pop stale tops whose count no longer matches; the top is the answer, or 0 if the heap is empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'heap', 'leetcode'],
    'related_session' => 'most-frequent-ids',
];
