<?php
declare(strict_types=1);

return [
    'title' => 'Elevator Requests II: interval DP on the line',
    'leetcode' => 4023,
    'difficulty' => 'Hard',
    'summary' => 'The floors already passed always form an interval around start, and the elevator stands at one end of it. Each second costs the number of unserved requests, so dp over (left end, right end, side) adds distance × requests still waiting.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'elevator-requests-ii',
];
