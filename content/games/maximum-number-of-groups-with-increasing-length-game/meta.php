<?php
declare(strict_types=1);

return [
    'title' => 'Groups With Increasing Length: accumulate sorted limits',
    'leetcode' => 2790,
    'difficulty' => 'Hard',
    'summary' => 'Sort limits. Group count k is reachable once the accumulated usage is at least 1 + 2 + … + k; scanning sorted limits, bump k whenever total at least (k + 1)(k + 2) divided by 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-groups-with-increasing-length',
    'related_session' => 'maximum-number-of-groups-with-increasing-length',
];
