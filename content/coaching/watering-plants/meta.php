<?php
declare(strict_types=1);

return [
    'title' => 'Watering Plants: refill only when needed',
    'leetcode' => 2079,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: never refill early, a refill before plant i costs 2 · i extra steps, refill when the can holds less than the plant needs. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'watering-plants',
    'tags' => ['simulation', 'array', 'step-by-step'],
];
