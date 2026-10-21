<?php
declare(strict_types=1);

return [
    'title' => 'Design Bounded Blocking Queue: wait in loops',
    'leetcode' => 1188,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: protect a deque with one lock, wait on not_full and not_empty conditions in while loops, and notify the other side after each change. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'related_guide' => 'design-bounded-blocking-queue',
    'tags' => ['concurrency', 'design', 'queue', 'step-by-step'],
];
