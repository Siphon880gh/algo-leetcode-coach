<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Pair Removal to Sort Array II: heap, linked list, and a bad-pair count',
    'leetcode' => 3510,
    'difficulty' => 'Hard',
    'summary' => 'Keep a min-heap of (pair sum, left index) with lazy deletion, a doubly linked list of live elements, and the number of adjacent pairs where left > right. Each merge touches at most three adjacent pairs, so update the count and stop when it reaches 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'linked-list', 'doubly-linked-list', 'ordered-set', 'simulation', 'heap', 'leetcode'],
    'related_session' => 'minimum-pair-removal-to-sort-array-ii',
];
