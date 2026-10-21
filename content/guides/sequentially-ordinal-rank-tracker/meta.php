<?php
declare(strict_types=1);

return [
    'title' => 'Sequentially Ordinal Rank Tracker: two heaps around the pointer',
    'leetcode' => 2102,
    'difficulty' => 'Hard',
    'summary' => 'Keep the best i locations seen so far in a heap whose top is the worst of them, and the rest in a heap whose top is the best of them. Each add pushes into the top set and moves its worst out; each get moves the best of the rest in and returns it.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'design', 'data-stream', 'leetcode'],
    'related_session' => 'sequentially-ordinal-rank-tracker',
];
