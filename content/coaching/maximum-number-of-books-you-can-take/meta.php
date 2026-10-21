<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Books You Can Take: key books[i] − i, capped sums',
    'leetcode' => 2355,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: compare shelves by books[i] − i, cap the arithmetic run at books[i] terms, and jump to the stopping shelf’s dp. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'related_guide' => 'maximum-number-of-books-you-can-take',
    'tags' => ['array', 'stack', 'dynamic-programming', 'monotonic-stack', 'step-by-step'],
];
