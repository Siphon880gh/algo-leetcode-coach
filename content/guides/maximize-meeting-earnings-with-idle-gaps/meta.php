<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Meeting Earnings with Idle Gaps: DP with a running max of value minus end',
    'leetcode' => 4068,
    'difficulty' => 'Hard',
    'summary' => 'Sort by end time and let each meeting extend the best earlier schedule by its start minus that schedule\'s end, kept as a running maximum of value minus end.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'sorting', 'binary-search', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximize-meeting-earnings-with-idle-gaps',
];
