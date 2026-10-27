<?php
declare(strict_types=1);

return [
    'title' => 'Calculate Score After Performing Instructions: simulate with a visited set',
    'leetcode' => 3522,
    'difficulty' => 'Med',
    'summary' => 'Start at index 0 with score 0. Mark each index before running it. "add" adds values[i] and moves to i plus 1; "jump" moves to i plus values[i]. Stop when the index leaves the array or was already marked.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'tags' => ['mini-game', 'leetcode', 'simulation'],
    'entry' => 'index.html',
    'related_guide' => 'calculate-score-after-performing-instructions',
    'related_session' => 'calculate-score-after-performing-instructions',
];
