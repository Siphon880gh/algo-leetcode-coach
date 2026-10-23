<?php
declare(strict_types=1);

return [
    'title' => 'Meeting Rooms III',
    'leetcode' => 2402,
    'difficulty' => 'Hard',
    'summary' => 'Process meetings by start. Free rooms in a min-heap by index; busy rooms by (end, index). Release rooms ending ≤ start; if none free, delay the meeting into the earliest-ending room. Return the room used most (smallest index on ties).',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'meeting-rooms-iii',
    'related_session' => 'meeting-rooms-iii',
];
