<?php
declare(strict_types=1);

return [
    'title' => 'Find the Longest Equal Subarray: a window over each value’s positions',
    'leetcode' => 2831,
    'difficulty' => 'Med',
    'summary' => 'For each value, slide over its positions. Between positions p[l] and p[r] there are (p[r] − p[l]) − (r − l) other elements to delete; keep that at most k and maximise r − l + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'binary-search', 'sliding-window', 'leetcode'],
    'related_session' => 'find-the-longest-equal-subarray',
];
