<?php
declare(strict_types=1);

return [
    'title' => 'Super Egg Drop: floors per moves and eggs',
    'leetcode' => 887,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: flip the question to "how many floors can m moves and k eggs resolve", use f(m, k) = f(m−1, k−1) + f(m−1, k) + 1, and stop at the first m reaching n. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'super-egg-drop',
    'tags' => ['dynamic-programming', 'binary-search', 'math', 'step-by-step'],
];
