<?php
declare(strict_types=1);

return [
    'title' => 'Probability of Two Boxes Having the Same Number of Distinct Balls: count weighted splits',
    'leetcode' => 1467,
    'difficulty' => 'Hard',
    'summary' => 'For each colour choose how many balls go to box 1 (weighted by C(count, x)). Count the splits with half the balls in each box and equal distinct colours, and divide by C(total, total/2).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'backtracking', 'leetcode'],
    'related_session' => 'probability-of-a-two-boxes-having-the-same-number-of-distinct-balls',
];
