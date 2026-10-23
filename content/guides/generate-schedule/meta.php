<?php
declare(strict_types=1);

return [
    'title' => 'Generate Schedule: greedy over matches grouped by offset',
    'leetcode' => 3680,
    'difficulty' => 'Med',
    'summary' => 'Below 5 teams no schedule exists (a search over every order confirms it for 2, 3 and 4). For n ≥ 5, list the matches (i, (i + d) mod n) for d = 1 … n − 1 with even i first, then odd i, and each day take the first remaining match that shares no team with the previous day’s.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'math', 'leetcode'],
    'related_session' => 'generate-schedule',
];
