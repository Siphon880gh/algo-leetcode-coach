<?php
declare(strict_types=1);

return [
    'title' => 'Knight Probability: count the paths that stay on the board',
    'leetcode' => 688,
    'difficulty' => 'Med',
    'summary' => 'ways[r][c] = move sequences still on the board ending at (r,c). Each move sends every count to its 8 knight targets that are on the board. Probability = remaining ways / 8^k.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'knight-probability-in-chessboard',
    'related_session' => 'knight-probability-in-chessboard',
];
