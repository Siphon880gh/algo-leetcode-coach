<?php
declare(strict_types=1);

return [
    'title' => 'Meeting Scheduler',
    'leetcode' => 1229,
    'difficulty' => 'Med',
    'summary' => 'Sort both slot lists by start. Two pointers: the overlap is [max(starts), min(ends)]; if it fits the duration, return its start + duration. Advance whichever slot ends first.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'meeting-scheduler',
    'related_session' => 'meeting-scheduler',
];
