<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Segment Sum After Removals: add back in reverse with union-find',
    'leetcode' => 2382,
    'difficulty' => 'Hard',
    'summary' => 'Process removals backwards, so elements are added instead. Each added index joins its active neighbours in union-find with segment sums, and the running maximum before each addition is the answer for that query.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['array', 'union-find', 'ordered-set', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-segment-sum-after-removals',
];
