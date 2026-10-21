<?php
declare(strict_types=1);

return [
    'title' => 'Matchsticks to Square: four buckets, longest first, prune hard',
    'leetcode' => 473,
    'difficulty' => 'Med',
    'summary' => 'Use every stick exactly once to form a square. Total must be divisible by 4, and no stick may exceed side = total / 4. Sort sticks descending and place each into one of 4 sides without exceeding the side; skip a side that has the same length as an earlier one. Or bitmask DP over used sticks. [1,1,2,2,2] → true. [3,3,3,3,4] → false. 698 is the general k-bucket version.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'bitmask', 'dynamic-programming', 'leetcode'],
    'related_session' => 'matchsticks-to-square',
];
