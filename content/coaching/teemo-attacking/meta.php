<?php
declare(strict_types=1);

return [
    'title' => 'Teemo Attacking: add min(duration, gap) per attack',
    'leetcode' => 495,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: total poisoned seconds when each attack poisons for duration and resets the timer. Add min(duration, next − current) per attack plus duration for the last one. [1,4], 2 → 4. [1,2], 2 → 3. Not 56. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'tags' => ['arrays', 'simulation', 'step-by-step'],
    'related_guide' => 'teemo-attacking',
];
