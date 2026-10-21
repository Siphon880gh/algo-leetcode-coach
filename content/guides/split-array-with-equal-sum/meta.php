<?php
declare(strict_types=1);

return [
    'title' => 'Split Array with Equal Sum: fix the middle cut, match sums on both sides',
    'leetcode' => 548,
    'difficulty' => 'Hard',
    'summary' => 'Find cuts i, j, k (each removed, with gaps) so the four parts have equal sums. With prefix sums, fix j; collect every sum where a left cut i makes parts 1 and 2 equal into a set; then check whether some right cut k makes parts 3 and 4 equal with a sum in the set. O(n²). [1,2,1,2,1,2,1] → true.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'hash-table', 'arrays', 'leetcode'],
    'related_session' => 'split-array-with-equal-sum',
];
