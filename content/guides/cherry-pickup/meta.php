<?php
declare(strict_types=1);

return [
    'title' => 'Cherry Pickup: two walkers moving together',
    'leetcode' => 741,
    'difficulty' => 'Hard',
    'summary' => 'The round trip equals two paths from the top-left to the bottom-right. Move both walkers one step at a time, so after t steps they are on the same anti-diagonal. dp over (t, r1, r2) counts a shared cell once.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'cherry-pickup',
];
