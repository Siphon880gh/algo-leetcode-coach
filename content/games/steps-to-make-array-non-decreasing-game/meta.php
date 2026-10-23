<?php
declare(strict_types=1);

return [
    'title' => 'Steps to Make Array Non-decreasing',
    'leetcode' => 2289,
    'difficulty' => 'Med',
    'summary' => 'Monotonic stack of (value, steps until removed). For x, pop smaller-or-equal elements, keeping the max of their steps; if something larger remains, x dies one step after that max, else it never dies (0).',
    'category' => 'LeetCode',
    'subcategory' => 'Linked List',
    'topic' => 'LeetCode · Linked List',
    'tags' => ['linked-list', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'steps-to-make-array-non-decreasing',
    'related_session' => 'steps-to-make-array-non-decreasing',
];
