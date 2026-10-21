<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Events That Can Be Attended: earliest deadline first',
    'leetcode' => 1353,
    'difficulty' => 'Med',
    'summary' => 'Sweep the days. Each day, add events that start that day to a min-heap of end days, drop events that already ended, and attend the one ending soonest.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'heap', 'sorting', 'leetcode'],
    'related_session' => 'maximum-number-of-events-that-can-be-attended',
];
