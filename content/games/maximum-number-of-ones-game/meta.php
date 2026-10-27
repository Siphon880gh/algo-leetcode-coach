<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Ones: count each pattern cell',
    'leetcode' => 1183,
    'difficulty' => 'Hard',
    'summary' => 'Any side times side window sees each offset (i, j) exactly once, so the matrix is determined by which offsets hold ones. Offset (i, j) repeats ((width − i) divided by side, rounded up) times ((height − j) divided by side, rounded up) times; pick the maxOnes largest counts.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-ones',
    'related_session' => 'maximum-number-of-ones',
];
