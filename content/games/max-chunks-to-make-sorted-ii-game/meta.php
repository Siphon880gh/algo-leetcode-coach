<?php
declare(strict_types=1);

return [
    'title' => 'Max Chunks To Make Sorted II',
    'leetcode' => 768,
    'difficulty' => 'Hard',
    'summary' => 'Stack of chunk maxima. For each x: if x at least top, push; else pop all chunks with max > x and push back the largest popped max (merging). Answer = stack size.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'max-chunks-to-make-sorted-ii',
    'related_session' => 'max-chunks-to-make-sorted-ii',
];
