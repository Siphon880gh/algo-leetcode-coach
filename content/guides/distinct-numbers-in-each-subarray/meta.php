<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Numbers in Each Subarray: sliding window counter',
    'leetcode' => 1852,
    'difficulty' => 'Med',
    'summary' => 'Keep a frequency map for the current window. Slide by adding the new element and decrementing the leaving one, deleting keys that reach 0; the map size is the answer for each window.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'hash-table', 'array', 'leetcode'],
    'related_session' => 'distinct-numbers-in-each-subarray',
];
