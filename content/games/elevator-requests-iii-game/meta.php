<?php
declare(strict_types=1);

return [
    'title' => 'Elevator Requests III',
    'leetcode' => 4027,
    'difficulty' => 'Hard',
    'summary' => 'With at most 16 requests, use a bitmask DP over the order of fulfilment: dp[mask][last] = earliest time standing on request last\'s floor having fulfilled mask. Going next to j takes max(time + distance, arrival_j), since you can always wait at the floor.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'elevator-requests-iii',
    'related_session' => 'elevator-requests-iii',
];
