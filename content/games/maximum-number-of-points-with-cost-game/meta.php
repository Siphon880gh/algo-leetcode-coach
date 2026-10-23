<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points with Cost: left and right sweeps',
    'leetcode' => 1937,
    'difficulty' => 'Med',
    'summary' => 'From the previous row, best reachable into column c is max over k of prev[k] − |k − c|. A left-to-right sweep (left[c] = max(left[c−1] − 1, prev[c])) and a right-to-left sweep give it in O(n).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-points-with-cost',
    'related_session' => 'maximum-number-of-points-with-cost',
];
