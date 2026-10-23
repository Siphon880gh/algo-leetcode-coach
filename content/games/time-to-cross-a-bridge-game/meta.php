<?php
declare(strict_types=1);

return [
    'title' => 'Time to Cross a Bridge',
    'leetcode' => 2532,
    'difficulty' => 'Hard',
    'summary' => 'Simulate with four heaps: waiting on each side (least efficient first: larger left+right, then larger index) and working on each side (by finish time). Right-side waiters cross first; left-side waiters cross only while boxes remain unassigned. When idle, jump to the next finish time.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'time-to-cross-a-bridge',
    'related_session' => 'time-to-cross-a-bridge',
];
