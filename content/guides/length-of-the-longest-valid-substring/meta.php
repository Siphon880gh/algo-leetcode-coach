<?php
declare(strict_types=1);

return [
    'title' => 'Length of the Longest Valid Substring: check short endings only',
    'leetcode' => 2781,
    'difficulty' => 'Hard',
    'summary' => 'Forbidden strings have at most 10 letters. For each right end r, check the substrings ending at r of length up to 10 that start at or after l; on a hit, move l just past its start.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'string', 'sliding-window', 'leetcode'],
    'related_session' => 'length-of-the-longest-valid-substring',
];
