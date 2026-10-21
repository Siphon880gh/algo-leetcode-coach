<?php
declare(strict_types=1);

return [
    'title' => 'Shopping Offers: DFS over the remaining needs',
    'leetcode' => 638,
    'difficulty' => 'Med',
    'summary' => 'The state is the tuple of items still needed. Its cost is either buying everything at list price, or applying any offer that does not overshoot and recursing. Memoize on the tuple.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'memoization', 'backtracking', 'leetcode'],
    'related_session' => 'shopping-offers',
];
