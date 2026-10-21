<?php
declare(strict_types=1);

return [
    'title' => 'Freedom Trail: DP over key index and ring position, circular distance',
    'leetcode' => 514,
    'difficulty' => 'Hard',
    'summary' => 'Spell key by rotating ring to 12:00 (1 step per position) and pressing (1 step per char). f[i][j] = minimal steps after spelling key[0..i] with ring[j] at the top: min over positions k of key[i − 1] of f[i − 1][k] + min(|j − k|, n − |j − k|) + 1. "godding", "gd" → 4. Greedy nearest char fails.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'bfs', 'leetcode'],
    'related_session' => 'freedom-trail',
];
