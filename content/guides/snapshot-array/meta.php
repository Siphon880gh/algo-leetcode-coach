<?php
declare(strict_types=1);

return [
    'title' => 'Snapshot Array: per-index history with binary search',
    'leetcode' => 1146,
    'difficulty' => 'Med',
    'summary' => 'Store, for each index, the list of (snap_id, value) changes. set updates or appends to that list, snap bumps a counter, and get binary searches the last change made at or before the requested snapshot.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'binary-search', 'hash-table', 'arrays', 'leetcode'],
    'related_session' => 'snapshot-array',
];
