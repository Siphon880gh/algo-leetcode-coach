<?php
declare(strict_types=1);

return [
    'title' => 'Number of Sets of K Non-Overlapping Line Segments: stars and bars',
    'leetcode' => 1621,
    'difficulty' => 'Med',
    'summary' => 'Segments may share endpoints. Counting gives C(n + k − 1, 2k) mod 1e9+7; a DP over (point, segments, open?) also works.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['combinatorics', 'dynamic-programming', 'math', 'leetcode'],
    'related_session' => 'number-of-sets-of-k-non-overlapping-line-segments',
];
