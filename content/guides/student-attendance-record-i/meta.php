<?php
declare(strict_types=1);

return [
    'title' => 'Student Attendance Record I: fewer than 2 A and no LLL',
    'leetcode' => 551,
    'difficulty' => 'Easy',
    'summary' => 'A record of A (absent), L (late), P (present) earns an award if it has fewer than 2 As and never 3 Ls in a row. Check s.count("A") < 2 and "LLL" not in s, or one pass with a late streak. "PPALLP" → true. "PPALLL" → false. Not 552.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'leetcode'],
    'related_session' => 'student-attendance-record-i',
];
