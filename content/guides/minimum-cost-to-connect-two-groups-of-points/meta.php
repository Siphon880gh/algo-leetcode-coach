<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Connect Two Groups of Points: bitmask DP',
    'leetcode' => 1595,
    'difficulty' => 'Hard',
    'summary' => 'Process group-1 points one by one with a mask of group-2 points already covered. Each group-1 point picks one partner; at the end, every uncovered group-2 point joins via its cheapest edge.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'minimum-cost-to-connect-two-groups-of-points',
];
