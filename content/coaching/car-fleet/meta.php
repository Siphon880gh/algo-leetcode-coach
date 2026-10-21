<?php
declare(strict_types=1);

return [
    'title' => 'Car Fleet: sort by position, compare arrival times',
    'leetcode' => 853,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: process cars from nearest the target backward and start a new fleet only when a car would arrive later than the fleet ahead. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'related_guide' => 'car-fleet',
    'tags' => ['sorting', 'monotonic-stack', 'arrays', 'step-by-step'],
];
