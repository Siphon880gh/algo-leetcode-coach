<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR Score Subarray Queries: a Pascal-like XOR table',
    'leetcode' => 3277,
    'difficulty' => 'Hard',
    'summary' => 'score[l][r] = score[l][r−1] XOR score[l+1][r] (the repeated-XOR reduction). best[l][r] = max(score[l][r], best[l][r−1], best[l+1][r]). Answer each query from best.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-xor-score-subarray-queries',
    'related_session' => 'maximum-xor-score-subarray-queries',
];
