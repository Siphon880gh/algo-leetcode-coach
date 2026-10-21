<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game III: score-difference DP',
    'leetcode' => 1406,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: f(i) = max over taking 1–3 stones of their sum minus f(i + k), and read the winner from the sign of f(0). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'stone-game-iii',
    'tags' => ['dynamic-programming', 'game-theory', 'step-by-step'],
];
