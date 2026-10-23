<?php
declare(strict_types=1);

return [
    'title' => 'Weighted Sum of a Tree: depths, then one sum',
    'leetcode' => 4015,
    'difficulty' => 'Med',
    'summary' => 'Compute every depth with BFS from the root. The height h is the largest depth, and the answer is Σ nums[i] · (h − d_i + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'leetcode'],
    'related_session' => 'weighted-sum-of-a-tree',
];
