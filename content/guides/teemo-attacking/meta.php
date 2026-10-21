<?php
declare(strict_types=1);

return [
    'title' => 'Teemo Attacking: add min(duration, gap) per attack',
    'leetcode' => 495,
    'difficulty' => 'Easy',
    'summary' => 'Each attack at time t poisons [t, t + duration − 1]; a new attack resets the timer. Total poisoned seconds = duration for the last attack plus, for each earlier attack, min(duration, next time − this time). [1,4], 2 → 4. [1,2], 2 → 3. Not 56.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['arrays', 'simulation', 'intervals', 'leetcode'],
    'related_session' => 'teemo-attacking',
];
