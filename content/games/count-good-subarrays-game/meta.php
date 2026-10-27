<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Subarrays',
    'leetcode' => 3878,
    'difficulty' => 'Hard',
    'summary' => 'OR equals some element only if that element contains every bit, i.e. it is the maximum and a superset of the rest. For each index as the owner, extend left and right while elements are submasks of it (stopping at an equal value on one side to avoid double counting); monotonic stacks find those borders fast.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'tags' => ['stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-good-subarrays',
    'related_session' => 'count-good-subarrays',
];
