<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Minimum Game Score',
    'leetcode' => 3449,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the target v. Index i needs v divided by points[i] (rounded up) visits. Walk left to right: enter i once, then bounce from i to i + 1 and back to i for each extra visit (2 moves each), which also pre-pays visits to i + 1. Feasible if the moves stay at most m.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-the-minimum-game-score',
    'related_session' => 'maximize-the-minimum-game-score',
];
