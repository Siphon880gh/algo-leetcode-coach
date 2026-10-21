<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Halve Array Sum: always halve the largest',
    'leetcode' => 2208,
    'difficulty' => 'Med',
    'summary' => 'Use a max-heap. Repeatedly halve the largest current value and add the removed half to the reduction until it reaches half the original sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'heap', 'leetcode'],
    'related_session' => 'minimum-operations-to-halve-array-sum',
];
