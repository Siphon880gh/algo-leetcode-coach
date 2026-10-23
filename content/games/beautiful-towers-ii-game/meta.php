<?php
declare(strict_types=1);

return [
    'title' => 'Beautiful Towers II',
    'leetcode' => 2866,
    'difficulty' => 'Med',
    'summary' => 'left[i] = best non-decreasing sum ending at i with height maxHeights[i]: pop larger limits from a stack and fill that stretch at maxHeights[i]. Same from the right; maximize left[i] + right[i] − maxHeights[i].',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'beautiful-towers-ii',
    'related_session' => 'beautiful-towers-ii',
];
