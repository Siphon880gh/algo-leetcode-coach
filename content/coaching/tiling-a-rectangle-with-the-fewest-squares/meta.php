<?php
declare(strict_types=1);

return [
    'title' => 'Tiling a Rectangle with the Fewest Squares: lowest gap first',
    'leetcode' => 1240,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: track column heights, always fill the lowest leftmost gap, try the largest square that fits first, and prune branches that cannot beat the best. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'tiling-a-rectangle-with-the-fewest-squares',
    'tags' => ['backtracking', 'step-by-step'],
];
