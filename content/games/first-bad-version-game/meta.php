<?php
declare(strict_types=1);

return [
    'title' => 'First Bad Version: a bad mid could be the first',
    'leetcode' => 278,
    'difficulty' => 'Easy',
    'summary' => 'If mid is bad, the first bad version is mid or earlier, so keep mid (hi = mid). If mid is good, it is after mid (lo = mid + 1). Stop when lo == hi.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'first-bad-version',
    'related_session' => 'first-bad-version',
];
