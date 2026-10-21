<?php
declare(strict_types=1);

return [
    'title' => 'Course Schedule III: deadline order with a max-heap',
    'leetcode' => 630,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort by last day, take each course, and when the total passes the deadline, drop the longest course so far. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'course-schedule-iii',
    'tags' => ['greedy', 'heap', 'sorting', 'step-by-step'],
];
