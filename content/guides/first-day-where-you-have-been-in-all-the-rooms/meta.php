<?php
declare(strict_types=1);

return [
    'title' => 'First Day Where You Have Been in All the Rooms: day-of-first-arrival DP',
    'leetcode' => 1997,
    'difficulty' => 'Med',
    'summary' => 'Reaching room i for the first time means every room before it has an even count. f[i] = 2·f[i − 1] − f[nextVisit[i − 1]] + 2: from room i − 1 you bounce back to nextVisit[i − 1], replay the walk to i − 1, then step forward.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'first-day-where-you-have-been-in-all-the-rooms',
];
