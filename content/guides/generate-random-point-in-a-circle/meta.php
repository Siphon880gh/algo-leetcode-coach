<?php
declare(strict_types=1);

return [
    'title' => 'Generate Random Point in a Circle: sqrt the radius, or reject from the square',
    'leetcode' => 478,
    'difficulty' => 'Med',
    'summary' => 'Return a uniform random point inside a circle. Picking radius uniform in [0, r] crowds points near the center. Use radius = r × sqrt(u) with an angle uniform in [0, 2π). Or sample the bounding square and retry until inside (accepts about 78.5% of the time). Not 470.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'geometry', 'probability', 'rejection-sampling', 'leetcode'],
    'related_session' => 'generate-random-point-in-a-circle',
];
