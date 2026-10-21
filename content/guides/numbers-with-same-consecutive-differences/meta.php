<?php
declare(strict_types=1);

return [
    'title' => 'Numbers With Same Consecutive Differences: grow digits by ±k',
    'leetcode' => 967,
    'difficulty' => 'Med',
    'summary' => 'Start from each first digit 1 to 9 and extend one digit at a time with last ± k, keeping digits in 0 to 9. After n digits, collect the numbers; when k = 0 the two choices coincide, so add only one.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'bfs', 'leetcode'],
    'related_session' => 'numbers-with-same-consecutive-differences',
];
