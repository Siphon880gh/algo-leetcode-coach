<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Possible Maximum Waiting Time',
    'leetcode' => 4009,
    'difficulty' => 'Hard',
    'summary' => 'Search over cars in order with state (fuel left at each dispenser, time each frees up, current time). Each car picks a dispenser with enough fuel, waits until it frees, and then the next car becomes allowed. Memoise on the state, maximising cars served first and then minimising the worst wait.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-possible-maximum-waiting-time',
    'related_session' => 'minimum-possible-maximum-waiting-time',
];
