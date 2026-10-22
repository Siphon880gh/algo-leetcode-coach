<?php
declare(strict_types=1);

return [
    'title' => 'Maximal Score After Applying K Operations: always take the largest',
    'leetcode' => 2530,
    'difficulty' => 'Med',
    'summary' => 'Each operation should take the current largest value, since taking it never shrinks any later option. Use a max-heap: pop, add to the score, push ceil(x / 3), k times.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'heap', 'leetcode'],
    'related_session' => 'maximal-score-after-applying-k-operations',
];
