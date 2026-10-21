<?php
declare(strict_types=1);

return [
    'title' => 'Guess the Word: filter candidates, guess to split them evenly',
    'leetcode' => 843,
    'difficulty' => 'Hard',
    'summary' => 'After guessing w and hearing m matches, the secret must share exactly m positions with w, so keep only those candidates. Choose each guess to minimize the largest group of candidates that could remain (a minimax heuristic).',
    'category' => 'LeetCode',
    'subcategory' => 'Interactive',
    'topic' => 'LeetCode · Interactive',
    'kind' => 'algo',
    'tags' => ['interactive', 'game-theory', 'strings', 'leetcode'],
    'related_session' => 'guess-the-word',
];
