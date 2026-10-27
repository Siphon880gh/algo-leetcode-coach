<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Strings',
    'leetcode' => 4073,
    'difficulty' => 'Hard',
    'summary' => 'Every split must cut between two runs, so a string is good exactly when every run has odd length. Ordered sums of odd parts follow c(n) = c(n − 1) + c(n − 2): the last part is 1, or a last part of at least 3 shrinks by 2. That is Fibonacci, so the answer is 2 · F(n), with fast doubling for n up to 10^15.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-good-strings',
    'related_session' => 'count-good-strings',
];
