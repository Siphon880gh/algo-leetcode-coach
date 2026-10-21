<?php
declare(strict_types=1);

return [
    'title' => 'Solve the Equation: collect x terms and constants on each side',
    'leetcode' => 640,
    'difficulty' => 'Med',
    'summary' => 'Parse each side into (coefficient of x, constant). Move everything left: (a − c)·x = d − b. A zero coefficient means infinite or no solutions, depending on the constants.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'strings', 'parsing', 'leetcode'],
    'related_session' => 'solve-the-equation',
];
