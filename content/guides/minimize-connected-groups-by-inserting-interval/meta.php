<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Connected Groups by Inserting Interval: merge, then binary search the reach',
    'leetcode' => 3323,
    'difficulty' => 'Med',
    'summary' => 'Merge intervals into groups. A new interval starting at group i’s end can reach every group whose start is at most end_i + k. Binary search that farthest group; the best i saves the most groups.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'sorting', 'sliding-window', 'leetcode'],
    'related_session' => 'minimize-connected-groups-by-inserting-interval',
];
