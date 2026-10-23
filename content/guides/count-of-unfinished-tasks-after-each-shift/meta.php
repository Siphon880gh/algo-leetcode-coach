<?php
declare(strict_types=1);

return [
    'title' => 'Count of Unfinished Tasks After Each Shift: prefix sums and binary search',
    'leetcode' => 4012,
    'difficulty' => 'Med',
    'summary' => 'Keep the current task and the time already spent on it. A shift either stays inside that task, finishes everything (then restart at task 0 and drop the rest), or stops inside a later task, found by binary search on prefix sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'prefix-sum', 'leetcode'],
    'related_session' => 'count-of-unfinished-tasks-after-each-shift',
];
