<?php
declare(strict_types=1);

return [
    'title' => 'Delayed Count of Equal Elements',
    'leetcode' => 3837,
    'difficulty' => 'Med',
    'summary' => 'Sweep i from right to left with a count map that only holds indices j > i + k: before answering i, add nums[i + k + 1] (if it exists). Then ans[i] is the count of nums[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'delayed-count-of-equal-elements',
    'related_session' => 'delayed-count-of-equal-elements',
];
