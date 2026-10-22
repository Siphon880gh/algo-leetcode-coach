<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Robots Within Budget: sliding window with a max deque',
    'leetcode' => 2398,
    'difficulty' => 'Hard',
    'summary' => 'Cost only grows as a window widens, so slide a window and shrink it from the left while it is over budget. A decreasing deque gives the window’s largest charge time, and a running sum gives its running cost.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'queue', 'sliding-window', 'heap', 'prefix-sum', 'monotonic-queue', 'leetcode'],
    'related_session' => 'maximum-number-of-robots-within-budget',
];
