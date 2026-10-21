<?php
declare(strict_types=1);

return [
    'title' => 'Form Largest Integer With Digits That Add up to Target: max length, then greedy',
    'leetcode' => 1449,
    'difficulty' => 'Hard',
    'summary' => 'The number with more digits is larger, so first compute the most digits possible for each cost (unbounded knapsack). Then build greedily from 9 down, taking a digit whenever the rest can still be completed.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'knapsack', 'greedy', 'leetcode'],
    'related_session' => 'form-largest-integer-with-digits-that-add-up-to-target',
];
