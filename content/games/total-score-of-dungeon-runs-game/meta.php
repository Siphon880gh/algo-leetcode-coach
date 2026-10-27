<?php
declare(strict_types=1);

return [
    'title' => 'Total Score of Dungeon Runs',
    'leetcode' => 3771,
    'difficulty' => 'Med',
    'summary' => 'With prefix damage D, starting at j earns room i (i at least j) when hp − (D[i] − D[j−1]) at least req[i], i.e. D[j−1] at least D[i] − hp + req[i]. D is increasing, so binary search the first such j and count i − j + 1 starts for room i.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'total-score-of-dungeon-runs',
    'related_session' => 'total-score-of-dungeon-runs',
];
