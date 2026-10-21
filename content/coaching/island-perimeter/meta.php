<?php
declare(strict_types=1);

return [
    'title' => 'Island Perimeter: 4 per land cell, minus 2 per shared edge',
    'leetcode' => 463,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: perimeter of the single island in a 0/1 grid. Each land cell adds 4; each pair of touching land cells hides 2. Check only down and right so each pair counts once. [[0,1,0,0],[1,1,1,0],[0,1,0,0],[1,1,0,0]] → 16. [[1]] → 4. Not 200. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'tags' => ['matrix', 'math', 'arrays', 'step-by-step'],
    'related_guide' => 'island-perimeter',
];
