<?php
declare(strict_types=1);

return [
    'title' => 'Make the Prefix Sum Non-negative: move the worst negative',
    'leetcode' => 2599,
    'difficulty' => 'Med',
    'summary' => 'Walk the array with a running sum and a min-heap of the negatives seen so far. Whenever the sum drops below 0, move the most negative of them to the end: add it back and count one move.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'heap', 'leetcode'],
    'related_session' => 'make-the-prefix-sum-non-negative',
];
