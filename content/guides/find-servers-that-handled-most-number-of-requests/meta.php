<?php
declare(strict_types=1);

return [
    'title' => 'Find Servers That Handled Most Number of Requests: free set plus busy heap',
    'leetcode' => 1606,
    'difficulty' => 'Hard',
    'summary' => 'Keep busy servers in a min-heap by end time and free servers in a sorted set. For request i, release finished servers, then take the first free server ≥ i mod k, wrapping around; drop the request if none are free.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'ordered-set', 'simulation', 'leetcode'],
    'related_session' => 'find-servers-that-handled-most-number-of-requests',
];
