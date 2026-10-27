<?php
declare(strict_types=1);

return [
    'title' => 'Super Egg Drop: how many floors can m moves cover?',
    'leetcode' => 887,
    'difficulty' => 'Hard',
    'summary' => 'f[m][k] = floors you can fully test with m moves and k eggs = f[m−1][k−1] (egg breaks) + f[m−1][k] (survives) + 1. The answer is the first m with f[m][k] at least n.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'super-egg-drop',
    'related_session' => 'super-egg-drop',
];
