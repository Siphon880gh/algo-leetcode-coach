<?php
declare(strict_types=1);

return [
    'title' => 'Find Servers That Handled Most Number of Requests',
    'leetcode' => 1606,
    'difficulty' => 'Hard',
    'summary' => 'Keep busy servers in a min-heap by finish time and free servers in an ordered set. For request i, free servers whose time passed, then pick the first free index at least i mod k (wrapping); drop the request if none.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-servers-that-handled-most-number-of-requests',
    'related_session' => 'find-servers-that-handled-most-number-of-requests',
];
