<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Points Reachable After Substring Removal',
    'leetcode' => 3694,
    'difficulty' => 'Med',
    'summary' => 'The final point is the full walk\'s end minus the displacement of the removed window. Take prefix positions P; each window i..i+k−1 removes P[i+k] − P[i]. Count distinct results in a set.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'distinct-points-reachable-after-substring-removal',
    'related_session' => 'distinct-points-reachable-after-substring-removal',
];
