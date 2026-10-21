<?php
declare(strict_types=1);

return [
    'title' => 'Remove Boxes: interval DP with extra boxes of the same color attached',
    'leetcode' => 546,
    'difficulty' => 'Hard',
    'summary' => 'Removing k same-colored adjacent boxes scores k². Interval DP alone loses information, so add a third index: dfs(i, j, k) = best for boxes[i..j] with k more boxes equal to boxes[j] attached after j. Either remove boxes[j] with them now, or merge with an earlier same-colored box h. [1,3,2,2,2,3,4,3,1] → 23.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'memoization', 'interval-dp', 'leetcode'],
    'related_session' => 'remove-boxes',
];
