<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest Negated Permutation That Sums to Target',
    'leetcode' => 3752,
    'difficulty' => 'Med',
    'summary' => 'Start from 1 to n all positive (sum S). Negating a set N lowers the sum by 2 times sum(N), so we need sum(N) = (S − target) divided by 2 = D (integer, D from 0 to S). Greedily negate from n downwards whenever i at most D left; output sorted ascending.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'lexicographically-smallest-negated-permutation-that-sums-to-target',
    'related_session' => 'lexicographically-smallest-negated-permutation-that-sums-to-target',
];
