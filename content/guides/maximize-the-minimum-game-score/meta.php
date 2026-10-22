<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Minimum Game Score: binary search with a greedy walk',
    'leetcode' => 3449,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the minimum X. Index i needs ⌈X / points[i]⌉ visits. Walk left to right; extra visits at i come from stepping to i + 1 and back, 2 moves each, which also gives i + 1 free visits.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'binary-search', 'leetcode'],
    'related_session' => 'maximize-the-minimum-game-score',
];
