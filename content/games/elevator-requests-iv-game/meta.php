<?php
declare(strict_types=1);

return [
    'title' => 'Elevator Requests IV',
    'leetcode' => 4029,
    'difficulty' => 'Hard',
    'summary' => 'With up to 500 requests a bitmask is out. Sort by arrival; at any time the useful plan is to sweep an interval of floors, so think of the unmet requests\' floor span and use an interval DP over sorted floors with time states, or binary search the finishing time and check whether a left or right sweep covers every request after its arrival.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'elevator-requests-iv',
    'related_session' => 'elevator-requests-iv',
];
