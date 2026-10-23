<?php
declare(strict_types=1);

return [
    'title' => 'Ball Passing Game: sum the ids along k passes',
    'leetcode' => 2836,
    'difficulty' => 'Hard',
    'summary' => 'f(x) = x + receiver[x] + receiver²[x] + … (k passes). Binary lifting stores the 2^j-th receiver and the sum along the way; here, simulate each start.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-value-of-function-in-a-ball-passing-game',
    'related_session' => 'maximize-value-of-function-in-a-ball-passing-game',
];
