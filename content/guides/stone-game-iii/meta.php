<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game III: best score difference from each index',
    'leetcode' => 1406,
    'difficulty' => 'Hard',
    'summary' => 'f(i) is the best difference (current player minus the other) from index i. Taking 1, 2, or 3 stones gains their sum and leaves the opponent f(i + k), so f(i) = max(sum − f(i + k)).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'game-theory', 'leetcode'],
    'related_session' => 'stone-game-iii',
];
