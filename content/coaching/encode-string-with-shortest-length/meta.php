<?php
declare(strict_types=1);

return [
    'title' => 'Encode String with Shortest Length: interval DP with repeat detection',
    'leetcode' => 471,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: shortest encoding of s with k[sub]. f[i][j] = best encoding of s[i..j]. Candidates: the raw string, every split f[i][k] + f[k + 1][j], and, if s[i..j] repeats with period p, count[f[i][i + p − 1]]. Under length 5 stays raw. "aaaaa" → "5[a]". Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'strings', 'interval-dp', 'step-by-step'],
    'related_guide' => 'encode-string-with-shortest-length',
];
