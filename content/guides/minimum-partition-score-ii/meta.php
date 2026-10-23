<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Partition Score II: Aliens trick with a convex hull',
    'leetcode' => 3929,
    'difficulty' => 'Hard',
    'summary' => 'Σ s(s + 1) / 2 = (Σ s² + total) / 2, so minimize Σ s². That cost is convex in the number of parts, so charge λ per part, solve the unlimited version with a convex hull, and binary search λ until the part count hits k.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-partition-score-ii',
];
