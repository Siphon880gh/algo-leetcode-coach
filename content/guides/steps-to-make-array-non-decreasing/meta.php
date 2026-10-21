<?php
declare(strict_types=1);

return [
    'title' => 'Steps to Make Array Non-decreasing: monotonic stack of death times',
    'leetcode' => 2289,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right with a stack of (value, steps until removed). For x, pop smaller-or-equal values and take the largest of their times; if something larger remains, x dies one step after that, else it never dies. The answer is the largest time.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['array', 'linked-list', 'stack', 'monotonic-stack', 'leetcode'],
    'related_session' => 'steps-to-make-array-non-decreasing',
];
