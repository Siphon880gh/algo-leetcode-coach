<?php
declare(strict_types=1);

return [
    'title' => 'Meeting Rooms II: reuse the room that frees up first',
    'leetcode' => 253,
    'difficulty' => 'Med',
    'summary' => 'Sort by start. Keep a min-heap of end times (one per room). If the earliest end ≤ the new start, that room is free: reuse it. Otherwise open a new room.',
    'category' => 'LeetCode',
    'subcategory' => 'Intervals',
    'topic' => 'LeetCode · Intervals',
    'tags' => ['intervals', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'meeting-rooms-ii',
    'related_session' => 'meeting-rooms-ii',
];
