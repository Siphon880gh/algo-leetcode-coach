<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Fixed Points After Deletions: LIS on (i − v, v)',
    'leetcode' => 3920,
    'difficulty' => 'Hard',
    'summary' => 'Element v at index i can land on index v only if v ≤ i, after deleting i − v earlier elements. Kept fixed points need strictly increasing v and non-decreasing deletions i − v, so sort by (i − v, v) and take the strict LIS of v.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'maximize-fixed-points-after-deletions',
];
