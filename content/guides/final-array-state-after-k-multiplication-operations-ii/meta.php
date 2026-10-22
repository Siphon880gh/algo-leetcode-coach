<?php
declare(strict_types=1);

return [
    'title' => 'Final Array State After K Multiplication Operations II: simulate, then cycle',
    'leetcode' => 3266,
    'difficulty' => 'Hard',
    'summary' => 'Use a heap until even the smallest value times the multiplier exceeds the largest. From then on the operations cycle through the sorted array, so give each element k div n more and the first k mod n one extra, with fast powers mod 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'simulation', 'heap', 'leetcode'],
    'related_session' => 'final-array-state-after-k-multiplication-operations-ii',
];
