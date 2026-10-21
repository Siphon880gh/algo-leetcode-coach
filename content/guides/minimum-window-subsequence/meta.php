<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Window Subsequence: match forward, tighten backward',
    'leetcode' => 727,
    'difficulty' => 'Hard',
    'summary' => 'Scan s1 forward matching s2 letter by letter to find a window end. From that end, walk backward matching s2 in reverse to find the latest possible start. Record the window, then restart the forward scan just after that start.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'dynamic-programming', 'strings', 'sliding-window', 'leetcode'],
    'related_session' => 'minimum-window-subsequence',
];
