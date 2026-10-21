<?php
declare(strict_types=1);

return [
    'title' => 'Pyramid Transition Matrix: build each row with memoized backtracking',
    'leetcode' => 756,
    'difficulty' => 'Med',
    'summary' => 'Map every two-block pair to the blocks allowed on top of it. Build the row above the current one position by position with backtracking, recurse when it is complete, and memoize rows that are known to fail.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'memoization', 'hash-map', 'leetcode'],
    'related_session' => 'pyramid-transition-matrix',
];
