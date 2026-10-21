<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game VIII: prefix sums and a suffix DP',
    'leetcode' => 1872,
    'difficulty' => 'Hard',
    'summary' => 'Any move scores a prefix sum p[i] (i ≥ 2) and leaves a game that continues from i. Let f = best difference for the player to move; scanning from the right, f = max(f, p[i] − f), starting with f = p[n].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'game-theory', 'prefix-sum', 'leetcode'],
    'related_session' => 'stone-game-viii',
];
