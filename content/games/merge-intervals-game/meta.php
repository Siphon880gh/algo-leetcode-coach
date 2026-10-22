<?php
declare(strict_types=1);

return [
    'title' => 'Merge Intervals: overlap extends, a gap starts new',
    'leetcode' => 56,
    'difficulty' => 'Med',
    'summary' => 'Sort by start. Compare each interval with the last merged one: if it starts at or before that end, extend the end (max of both ends); otherwise start a new merged interval.',
    'category' => 'LeetCode',
    'subcategory' => 'Intervals',
    'topic' => 'LeetCode · Intervals',
    'tags' => ['intervals', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'merge-intervals',
    'related_session' => 'merge-intervals',
];
