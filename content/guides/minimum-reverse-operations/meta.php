<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Reverse Operations: BFS over a parity range',
    'leetcode' => 2612,
    'difficulty' => 'Hard',
    'summary' => 'From position i, one reversal can land the 1 on every position in a range [L, R] that has the same parity as i + k − 1. BFS over positions, keeping unvisited free positions in two sorted sets by parity so each is removed once.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'breadth-first-search', 'union-find', 'ordered-set', 'leetcode'],
    'related_session' => 'minimum-reverse-operations',
];
