<?php
declare(strict_types=1);

return [
    'title' => 'Furthest Building: ladders on the largest climbs',
    'leetcode' => 1642,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: push each positive climb into a min-heap; when it holds more than the ladder count, pay the smallest with bricks; stop when bricks go negative. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'furthest-building-you-can-reach',
    'tags' => ['heap', 'greedy', 'step-by-step'],
];
