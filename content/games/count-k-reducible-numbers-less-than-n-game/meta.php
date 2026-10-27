<?php
declare(strict_types=1);

return [
    'title' => 'Count k-Reducible Numbers: group by popcount',
    'leetcode' => 3352,
    'difficulty' => 'Hard',
    'summary' => 'ops(c) = steps for a number with c set bits to reach 1 = 1 + ops(popcount(c)), ops(1) = 0. x > 1 works if 1 + ops(popcount(x)) at most k (x = 1 needs 0). Count x < n with each popcount by walking n\'s bits (combinations).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-k-reducible-numbers-less-than-n',
    'related_session' => 'count-k-reducible-numbers-less-than-n',
];
