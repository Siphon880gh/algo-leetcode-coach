<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points Tourist Can Earn: DP over day and city',
    'leetcode' => 3332,
    'difficulty' => 'Med',
    'summary' => 'best[c] = most points with the tourist in city c after the days so far. Each day, city d takes the better of staying (best[d] + stay) and arriving from another city c (best[c] + travel[c][d]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'maximum-points-tourist-can-earn',
];
