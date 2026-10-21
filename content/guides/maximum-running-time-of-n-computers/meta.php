<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Running Time of N Computers: binary search the time',
    'leetcode' => 2141,
    'difficulty' => 'Hard',
    'summary' => 'All n computers can run T minutes iff Σ min(battery, T) ≥ n · T, since no battery can serve one computer for more than T and swaps are free. Binary search the largest such T up to sum / n.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'greedy', 'leetcode'],
    'related_session' => 'maximum-running-time-of-n-computers',
];
