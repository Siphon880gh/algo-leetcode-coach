<?php
declare(strict_types=1);

return [
    'title' => 'Remove Boxes: interval DP with extra boxes of the same color attached',
    'leetcode' => 546,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: removing k equal adjacent boxes scores k². dfs(i, j, k) = best for boxes[i..j] with k more boxes of boxes[j]\'s color attached on the right. Remove now, or clear a middle so an earlier same-color box joins. [1,3,2,2,2,3,4,3,1] → 23. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'memoization', 'interval-dp', 'step-by-step'],
    'related_guide' => 'remove-boxes',
];
