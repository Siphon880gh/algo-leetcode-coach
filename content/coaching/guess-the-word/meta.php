<?php
declare(strict_types=1);

return [
    'title' => 'Guess the Word: filter by exact match count',
    'leetcode' => 843,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: after each guess, keep only words with exactly that many matches against it, and pick guesses that split the candidates well. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Interactive',
    'topic' => 'LeetCode · Interactive',
    'related_guide' => 'guess-the-word',
    'tags' => ['interactive', 'game-theory', 'strings', 'step-by-step'],
];
