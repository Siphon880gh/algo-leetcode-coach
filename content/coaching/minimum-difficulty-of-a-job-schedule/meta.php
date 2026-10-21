<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Difficulty of a Job Schedule: split into d days',
    'leetcode' => 1335,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: f(i, k) chooses the last job j of the first day, adds the running max of jobs i..j, and recurses on f(j + 1, k − 1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-difficulty-of-a-job-schedule',
    'tags' => ['dynamic-programming', 'step-by-step'],
];
