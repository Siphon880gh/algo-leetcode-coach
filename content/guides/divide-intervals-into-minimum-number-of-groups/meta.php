<?php
declare(strict_types=1);

return [
    'title' => 'Divide Intervals Into Minimum Number of Groups: largest overlap with a heap',
    'leetcode' => 2406,
    'difficulty' => 'Med',
    'summary' => 'The answer is the largest number of intervals sharing one point. Sort by left end and keep a min-heap of group end points; reuse a group only when its end is strictly below the new left end, because touching intervals intersect.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'greedy', 'sorting', 'heap', 'prefix-sum', 'leetcode'],
    'related_session' => 'divide-intervals-into-minimum-number-of-groups',
];
