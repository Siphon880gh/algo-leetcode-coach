<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximal Uncovered Ranges: sort and track the covered end',
    'leetcode' => 2655,
    'difficulty' => 'Med',
    'summary' => 'Sort the ranges by start and remember the furthest covered cell so far. A range that starts more than one past it leaves a gap; after the last range, any cells beyond it form the final gap.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'kind' => 'algo',
    'tags' => ['array', 'sorting', 'leetcode'],
    'related_session' => 'find-maximal-uncovered-ranges',
];
