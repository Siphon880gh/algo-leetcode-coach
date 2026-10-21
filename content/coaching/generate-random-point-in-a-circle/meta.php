<?php
declare(strict_types=1);

return [
    'title' => 'Generate Random Point in a Circle: sqrt the radius, or reject from the square',
    'leetcode' => 478,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: return a uniform random point inside a circle. A uniform radius crowds the center; use ρ = r × sqrt(u) with an angle uniform in [0, 2π). Or sample the bounding square and retry until inside (about 78.5% accepted). Not 470. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'geometry', 'probability', 'rejection-sampling', 'step-by-step'],
    'related_guide' => 'generate-random-point-in-a-circle',
];
