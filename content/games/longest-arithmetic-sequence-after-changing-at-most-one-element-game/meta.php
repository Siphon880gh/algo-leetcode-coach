<?php
declare(strict_types=1);

return [
    'title' => 'Longest Arithmetic Sequence After Changing at Most One Element',
    'leetcode' => 3872,
    'difficulty' => 'Med',
    'summary' => 'Without a change, track arithmetic runs. Changing nums[i] can join the run ending at i−1 with the run starting at i+1 when (nums[i+1] − nums[i−1]) is twice the common difference, or extend one side by one element. Left and right run arrays make each i O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'tags' => ['array', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-arithmetic-sequence-after-changing-at-most-one-element',
    'related_session' => 'longest-arithmetic-sequence-after-changing-at-most-one-element',
];
