<?php
declare(strict_types=1);

return [
    'title' => 'Count Fertile Pyramids in a Land: height DP from below and from above',
    'leetcode' => 2088,
    'difficulty' => 'Hard',
    'summary' => 'f[i][j] = tallest pyramid with apex (i, j) = 1 + min of the three cells below, if the cell is fertile. Each apex adds f − 1 pyramids of height ≥ 2. Run it again on the flipped grid for inverse pyramids.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'count-fertile-pyramids-in-a-land',
];
