<?php
declare(strict_types=1);

return [
    'title' => 'Largest Perimeter Triangle: check the largest three that work',
    'leetcode' => 976,
    'difficulty' => 'Easy',
    'summary' => 'Sort descending. For a given longest side, the best partners are the next two largest. Return the first a[i] + a[i+1] + a[i+2] with a[i] < a[i+1] + a[i+2], or 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'math', 'leetcode'],
    'related_session' => 'largest-perimeter-triangle',
];
