<?php
declare(strict_types=1);

return [
    'title' => 'Pour Water: simulate each drop, left first',
    'leetcode' => 755,
    'difficulty' => 'Med',
    'summary' => 'For each unit, walk left while the next cell is not higher, remembering the nearest strictly lower position. If one exists, the unit lands there; otherwise do the same to the right; otherwise it stays at k. Add 1 to the chosen cell.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['simulation', 'arrays', 'leetcode'],
    'related_session' => 'pour-water',
];
