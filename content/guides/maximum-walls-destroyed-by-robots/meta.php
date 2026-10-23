<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Walls Destroyed by Robots: DP over sorted robots',
    'leetcode' => 3661,
    'difficulty' => 'Hard',
    'summary' => 'Sort robots and walls. A bullet’s range is cut at the neighbouring robots. Go left to right with two states (this robot fired left or right), subtracting walls counted twice when the previous robot fired right and this one fires left.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'maximum-walls-destroyed-by-robots',
];
