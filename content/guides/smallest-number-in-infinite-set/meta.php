<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Number in Infinite Set: a pointer plus a heap',
    'leetcode' => 2336,
    'difficulty' => 'Med',
    'summary' => 'Numbers from cur upward are all present, tracked by one pointer. Numbers below cur that were added back go in a min-heap with a set to stop duplicates. popSmallest takes from the heap first.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'hash-table', 'ordered-set', 'heap', 'leetcode'],
    'related_session' => 'smallest-number-in-infinite-set',
];
