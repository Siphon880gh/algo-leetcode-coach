<?php
declare(strict_types=1);

return [
    'title' => 'Maximize the Minimum Game Score',
    'leetcode' => 3449,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the target v. Index i needs ⌈v / points[i]⌉ visits. Walk left to right: enter i once, then bounce i → i + 1 → i for each extra visit (2 moves each), which also pre-pays visits to i + 1. Feasible if the moves stay ≤ m.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-the-minimum-game-score',
    'related_session' => 'maximize-the-minimum-game-score',
];
