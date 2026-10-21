<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Max Distance to Gas Station: binary search a real distance',
    'leetcode' => 774,
    'difficulty' => 'Hard',
    'summary' => 'For a candidate distance D, a gap g needs ceil(g / D) − 1 new stations. Binary search D on real numbers until the range is narrower than 1e-6, keeping D when the total needed is at most k.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'greedy', 'leetcode'],
    'related_session' => 'minimize-max-distance-to-gas-station',
];
