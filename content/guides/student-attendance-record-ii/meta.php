<?php
declare(strict_types=1);

return [
    'title' => 'Student Attendance Record II: DP over absences used and trailing lates',
    'leetcode' => 552,
    'difficulty' => 'Hard',
    'summary' => 'Count length-n records over A, L, P with fewer than 2 As and no LLL, mod 1e9 + 7. State = (A used: 0 or 1, trailing Ls: 0, 1, 2), six states. Each day add P (reset lates), L (lates + 1 if < 2), or A (only if none used; reset lates). n = 2 → 8. n = 1 → 3. Matrix power for huge n.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'student-attendance-record-ii',
];
