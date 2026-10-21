<?php
declare(strict_types=1);

return [
    'title' => 'Push Dominoes: net force from both directions',
    'leetcode' => 838,
    'difficulty' => 'Med',
    'summary' => 'Sweep left to right giving each cell a rightward force that starts at n after an R and decays by 1 per step (reset by L). Sweep right to left for leftward force. Each domino falls toward the stronger force, or stays up on a tie.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'dynamic-programming', 'strings', 'simulation', 'leetcode'],
    'related_session' => 'push-dominoes',
];
