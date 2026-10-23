<?php
declare(strict_types=1);

return [
    'title' => 'Two Best Non-Overlapping Events: best earlier event by end time',
    'leetcode' => 2054,
    'difficulty' => 'Med',
    'summary' => 'Sort by end time and keep a prefix max of values. For each event, add the best value among events ending strictly before its start.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'two-best-non-overlapping-events',
    'related_session' => 'two-best-non-overlapping-events',
];
