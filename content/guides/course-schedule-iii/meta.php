<?php
declare(strict_types=1);

return [
    'title' => 'Course Schedule III: by deadline, drop the longest course',
    'leetcode' => 630,
    'difficulty' => 'Hard',
    'summary' => 'Sort courses by last day. Take each one, adding its duration to a max-heap; whenever the total time passes the deadline, remove the longest course taken so far.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'heap', 'sorting', 'leetcode'],
    'related_session' => 'course-schedule-iii',
];
