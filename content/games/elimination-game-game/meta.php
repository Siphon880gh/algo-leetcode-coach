<?php
declare(strict_types=1);

return [
    'title' => 'Elimination Game: track only the head',
    'leetcode' => 390,
    'difficulty' => 'Med',
    'summary' => 'Keep head, step and remaining count. The head moves (head += step) on every left-to-right pass, and on right-to-left passes only when the count is odd. Then step doubles and the count halves.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'elimination-game',
    'related_session' => 'elimination-game',
];
