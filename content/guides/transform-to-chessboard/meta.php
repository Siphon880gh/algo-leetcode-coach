<?php
declare(strict_types=1);

return [
    'title' => 'Transform to Chessboard: validate rows, then count misplaced lines',
    'leetcode' => 782,
    'difficulty' => 'Hard',
    'summary' => 'Swaps keep every row equal to the first row or its complement, so check that pattern and the 1-counts first. Then the row and column fixes are independent: count the positions that differ from 0101… and take the cheaper valid parity.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'bit-manipulation', 'matrix', 'leetcode'],
    'related_session' => 'transform-to-chessboard',
];
