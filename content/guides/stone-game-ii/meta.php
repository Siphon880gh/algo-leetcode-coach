<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game II: DP on position and M',
    'leetcode' => 1140,
    'difficulty' => 'Med',
    'summary' => 'The game state is the next pile index and the current M. With suffix sums, the player to move gets the suffix total minus the best the opponent can do after taking x piles, for x from 1 to 2M.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'game-theory', 'prefix-sum', 'memoization', 'leetcode'],
    'related_session' => 'stone-game-ii',
];
