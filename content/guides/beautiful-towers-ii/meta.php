<?php
declare(strict_types=1);

return [
    'title' => 'Beautiful Towers II: monotonic stacks for both sides',
    'leetcode' => 2866,
    'difficulty' => 'Med',
    'summary' => 'left[i] is the best non-decreasing sum ending at peak i; a stack finds the previous smaller limit p, so left[i] = left[p] + h[i]·(i − p). Do the same from the right and combine.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['array', 'stack', 'monotonic-stack', 'leetcode'],
    'related_session' => 'beautiful-towers-ii',
];
