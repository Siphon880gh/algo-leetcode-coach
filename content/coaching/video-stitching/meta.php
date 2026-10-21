<?php
declare(strict_types=1);

return [
    'title' => 'Video Stitching: greedy reach',
    'leetcode' => 1024,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: record the furthest end per start time, sweep time keeping the furthest reach, and take a new clip whenever the current one ends. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'video-stitching',
    'tags' => ['greedy', 'arrays', 'dynamic-programming', 'step-by-step'],
];
