<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Flips to Convert Binary Matrix to Zero Matrix',
    'leetcode' => 1284,
    'difficulty' => 'Hard',
    'summary' => 'At most 9 cells → encode the matrix as a bitmask. BFS over masks; a move flips a cell and its 4 neighbors (XOR with a precomputed mask). First time mask 0 is reached → answer; never → −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-flips-to-convert-binary-matrix-to-zero-matrix',
    'related_session' => 'minimum-number-of-flips-to-convert-binary-matrix-to-zero-matrix',
];
