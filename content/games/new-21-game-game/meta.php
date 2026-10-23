<?php
declare(strict_types=1);

return [
    'title' => 'New 21 Game: a sliding window of probabilities',
    'leetcode' => 837,
    'difficulty' => 'Med',
    'summary' => 'P[x] = probability of ever having x points = (sum of P[x−maxPts..x−1] still drawing) / maxPts. Points ≥ k stop drawing. The answer is Σ P[x] for k ≤ x ≤ n.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'new-21-game',
    'related_session' => 'new-21-game',
];
