<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Manhattan Distance After k Changes: each change adds 2',
    'leetcode' => 3443,
    'difficulty' => 'Med',
    'summary' => 'After each prefix, distance = |N − S| + |E − W|. Each change of a "wrong-way" move adds 2, but the distance cannot exceed the prefix length: min(dist + 2k, i + 1). Take the best prefix.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-manhattan-distance-after-k-changes',
    'related_session' => 'maximum-manhattan-distance-after-k-changes',
];
