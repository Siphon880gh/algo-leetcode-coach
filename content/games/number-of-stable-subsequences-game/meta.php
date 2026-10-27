<?php
declare(strict_types=1);

return [
    'title' => 'Number of Stable Subsequences',
    'leetcode' => 3686,
    'difficulty' => 'Hard',
    'summary' => 'Track subsequences by their last parity and the length of the final same-parity run (1 or 2). A new element of parity p starts a run of 1 after any opposite-parity subsequence (or alone), or extends a run of 1 to 2; a run of 2 cannot grow.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-stable-subsequences',
    'related_session' => 'number-of-stable-subsequences',
];
