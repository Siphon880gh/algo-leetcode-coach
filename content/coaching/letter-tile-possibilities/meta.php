<?php
declare(strict_types=1);

return [
    'title' => 'Letter Tile Possibilities: branch on letters',
    'leetcode' => 1079,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a count per letter, and at each step try each letter still available, counting one sequence plus everything that follows. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'related_guide' => 'letter-tile-possibilities',
    'tags' => ['backtracking', 'counting', 'strings', 'step-by-step'],
];
