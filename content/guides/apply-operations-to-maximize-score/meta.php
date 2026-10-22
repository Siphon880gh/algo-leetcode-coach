<?php
declare(strict_types=1);

return [
    'title' => 'Apply Operations to Maximize Score: count each element’s subarrays',
    'leetcode' => 2818,
    'difficulty' => 'Hard',
    'summary' => 'Element i is the pick of every subarray where all elements left of it have a lower prime score and those to the right have one no higher. Count those with monotonic stacks, then use the largest values first, each up to its count, with fast power.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'stack', 'greedy', 'sorting', 'monotonic-stack', 'number-theory', 'leetcode'],
    'related_session' => 'apply-operations-to-maximize-score',
];
