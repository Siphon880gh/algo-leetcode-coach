<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Beautiful Subsequences',
    'leetcode' => 3671,
    'difficulty' => 'Hard',
    'summary' => 'f(g) = number of strictly increasing subsequences using only multiples of g (a Fenwick tree counts them). The count with gcd exactly g is f(g) minus the exact counts of 2g, 3g, …; go from large g down and add g times exact(g).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'sum-of-beautiful-subsequences',
    'related_session' => 'sum-of-beautiful-subsequences',
];
