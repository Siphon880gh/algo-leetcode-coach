<?php
declare(strict_types=1);

return [
    'title' => 'Find Users with Persistent Behavior Patterns: gaps and islands',
    'leetcode' => 3832,
    'difficulty' => 'Hard',
    'summary' => 'Keep only days with exactly one action. Within each (user, action), date minus row number is constant along a run of consecutive days, so group by it. Keep runs of at least 5 and rank each user’s runs by length, action, then latest start.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-users-with-persistent-behavior-patterns',
];
