<?php
declare(strict_types=1);

return [
    'title' => 'Super Egg Drop: how many floors can m moves and k eggs cover?',
    'leetcode' => 887,
    'difficulty' => 'Hard',
    'summary' => 'Flip the question: f(m, k) = f(m − 1, k − 1) + f(m − 1, k) + 1 is the most floors you can resolve with m moves and k eggs. The answer is the smallest m with f(m, k) ≥ n.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'binary-search', 'math', 'leetcode'],
    'related_session' => 'super-egg-drop',
];
