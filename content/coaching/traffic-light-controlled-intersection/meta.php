<?php
declare(strict_types=1);

return [
    'title' => 'Traffic Light Controlled Intersection: lock, switch if needed, cross',
    'leetcode' => 1279,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: guard the current green road with one lock, switch only when the arriving car\'s road differs, and let the car cross before releasing. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Concurrency',
    'topic' => 'LeetCode · Concurrency',
    'related_guide' => 'traffic-light-controlled-intersection',
    'tags' => ['concurrency', 'step-by-step'],
];
