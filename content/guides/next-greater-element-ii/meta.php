<?php
declare(strict_types=1);

return [
    'title' => 'Next Greater Element II: monotonic stack over two passes for the wrap',
    'leetcode' => 503,
    'difficulty' => 'Med',
    'summary' => 'Circular array: for each element, the first strictly larger value going forward with wraparound, else −1. Run a monotonic stack over indices 0..2n − 1 using i mod n, so every element also sees the elements before it. [1,2,1] → [2,−1,2]. [1,2,3,4,3] → [2,3,4,−1,4]. Not 496 / 739.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['stack', 'monotonic-stack', 'arrays', 'leetcode'],
    'related_session' => 'next-greater-element-ii',
];
