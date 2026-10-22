<?php
declare(strict_types=1);

return [
    'title' => 'Meeting Rooms III: a heap of free rooms and a heap of busy rooms',
    'leetcode' => 2402,
    'difficulty' => 'Hard',
    'summary' => 'Process meetings by start. Free every room whose meeting ended by then, take the lowest free room, or else delay the meeting into the room that frees earliest, lowest number on ties, and count meetings per room.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'sorting', 'heap', 'simulation', 'leetcode'],
    'related_session' => 'meeting-rooms-iii',
];
