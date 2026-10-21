<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Events That Can Be Attended: earliest end first',
    'leetcode' => 1353,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sweep days, push ends of events that have started, drop expired ones, and attend the event ending soonest each day. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-number-of-events-that-can-be-attended',
    'tags' => ['greedy', 'heap', 'sorting', 'step-by-step'],
];
