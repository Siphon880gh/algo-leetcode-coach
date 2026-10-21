<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Building Height: tighten restrictions both ways',
    'leetcode' => 1840,
    'difficulty' => 'Hard',
    'summary' => 'Add (1, 0) and (n, n − 1), sort restrictions by position, and tighten each limit by its left neighbour plus distance, then by its right neighbour plus distance. Between two adjacent limits the peak is (h1 + h2 + gap) // 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'math', 'leetcode'],
    'related_session' => 'maximum-building-height',
];
