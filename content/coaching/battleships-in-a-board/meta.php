<?php
declare(strict_types=1);

return [
    'title' => 'Battleships in a Board: count only the top-left X of each ship',
    'leetcode' => 419,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count ships on a board of X and dot. Ships are 1-by-k or k-by-1 and never touch. Count an X only when the cell above and the cell to the left are not X. One pass, O(1) extra, no board edits. [["X",".",".","X"],[".",".",".","X"],[".",".",".","X"]] → 2. Not 200. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'tags' => ['matrix', 'arrays', 'step-by-step'],
    'related_guide' => 'battleships-in-a-board',
];
