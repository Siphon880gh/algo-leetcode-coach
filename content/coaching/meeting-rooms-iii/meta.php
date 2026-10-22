<?php
declare(strict_types=1);

return [
    'title' => 'Meeting Rooms III: keep the duration, free at end ≤ start, lowest room on ties',
    'leetcode' => 2402,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep a delayed meeting’s length, free a room whose meeting ended at or before the start, and break count ties by the lowest room. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'meeting-rooms-iii',
    'tags' => ['array', 'hash-table', 'sorting', 'heap', 'simulation', 'step-by-step'],
];
