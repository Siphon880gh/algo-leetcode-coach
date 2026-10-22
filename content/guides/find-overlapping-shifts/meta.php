<?php
declare(strict_types=1);

return [
    'title' => 'Find Overlapping Shifts: self-join on overlaps',
    'leetcode' => 3262,
    'difficulty' => 'Med',
    'summary' => 'Join the table to itself on the same employee where one shift starts before the other and ends after the other starts, then count per employee.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-overlapping-shifts',
];
