<?php
declare(strict_types=1);

return [
    'title' => 'Count of Unfinished Tasks After Each Shift',
    'leetcode' => 4012,
    'difficulty' => 'Med',
    'summary' => 'Keep a pointer into the prefix sums of task times: the total work done since the last restart. Each shift adds its time; binary search how many tasks are fully done. If all finish, the leftover is discarded and the pointer resets to 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-of-unfinished-tasks-after-each-shift',
    'related_session' => 'count-of-unfinished-tasks-after-each-shift',
];
