<?php
declare(strict_types=1);

return [
    'title' => 'Range Module: a sorted list of disjoint half-open intervals',
    'leetcode' => 715,
    'difficulty' => 'Hard',
    'summary' => 'Store the tracked ranges as sorted, non-overlapping [left, right) intervals. add merges every interval it overlaps or touches, remove cuts the overlap out (splitting at the edges), and query finds the one interval that could contain the range.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'intervals', 'binary-search', 'ordered-set', 'leetcode'],
    'related_session' => 'range-module',
];
