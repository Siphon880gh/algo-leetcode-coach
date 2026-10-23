<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Frequency Score of a Subarray',
    'leetcode' => 2524,
    'difficulty' => 'Hard',
    'summary' => 'Score = Σ over distinct v of v^freq(v) mod 1e9+7. Slide a window of size k; update the score when a count changes (remove v^old, add v^new) and keep the maximum.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-frequency-score-of-a-subarray',
    'related_session' => 'maximum-frequency-score-of-a-subarray',
];
