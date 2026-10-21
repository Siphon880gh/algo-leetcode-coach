<?php
declare(strict_types=1);

return [
    'title' => 'Online Election: precompute leaders, binary search the time',
    'leetcode' => 911,
    'difficulty' => 'Med',
    'summary' => 'Replay the votes once, recording the leader after each vote (ties go to the most recent vote). A query at time t binary searches the last vote time ≤ t and returns that leader.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'design', 'hash-table', 'leetcode'],
    'related_session' => 'online-election',
];
