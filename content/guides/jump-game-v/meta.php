<?php
declare(strict_types=1);

return [
    'title' => 'Jump Game V: memoized DFS over lower neighbours',
    'leetcode' => 1340,
    'difficulty' => 'Hard',
    'summary' => 'From i you may jump up to d steps left or right, but only over and onto strictly lower bars, stopping at the first bar that is not lower. f(i) = 1 + the best f over reachable indices; memoize and take the max over all starts.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'dfs', 'leetcode'],
    'related_session' => 'jump-game-v',
];
