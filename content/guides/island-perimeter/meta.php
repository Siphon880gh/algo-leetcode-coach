<?php
declare(strict_types=1);

return [
    'title' => 'Island Perimeter: 4 per land cell, minus 2 per shared edge',
    'leetcode' => 463,
    'difficulty' => 'Easy',
    'summary' => 'Grid of 0/1 with exactly one island and no lakes. Every land cell adds 4 edges; every pair of land cells that share a side hides 2 edges (one on each). Count land and right/down neighbors in one pass: 4 × land − 2 × shared. [[0,1,0,0],[1,1,1,0],[0,1,0,0],[1,1,0,0]] → 16. [[1]] → 4. Not 200.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['matrix', 'math', 'arrays', 'leetcode'],
    'related_session' => 'island-perimeter',
];
