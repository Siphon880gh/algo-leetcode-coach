<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Unsorted Continuous Subarray',
    'leetcode' => 581,
    'difficulty' => 'Med',
    'summary' => 'Left to right, track the running max: any element below it marks the right end. Right to left, track the running min: any element above it marks the left end. Length = r − l + 1 (0 if sorted).',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'shortest-unsorted-continuous-subarray',
    'related_session' => 'shortest-unsorted-continuous-subarray',
];
