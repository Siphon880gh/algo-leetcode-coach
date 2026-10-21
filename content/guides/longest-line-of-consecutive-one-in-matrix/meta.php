<?php
declare(strict_types=1);

return [
    'title' => 'Longest Line of Consecutive One in Matrix: four DP directions',
    'leetcode' => 562,
    'difficulty' => 'Med',
    'summary' => 'Longest run of 1s in a row, column, diagonal, or anti-diagonal. For each 1, extend from its neighbor in each direction: left (horizontal), up (vertical), up-left (diagonal), up-right (anti-diagonal). Track the max. [[0,1,1,0],[0,1,1,0],[0,0,0,1]] → 3.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'longest-line-of-consecutive-one-in-matrix',
];
