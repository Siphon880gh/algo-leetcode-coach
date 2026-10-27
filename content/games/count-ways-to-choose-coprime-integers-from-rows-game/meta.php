<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Choose Coprime Integers From Rows',
    'leetcode' => 3725,
    'difficulty' => 'Hard',
    'summary' => 'f(d) = product over rows of how many entries are divisible by d — the ways whose gcd is a multiple of d. Go from the largest d down: exact(d) = f(d) − exact(2d) − exact(3d) − …; the answer is exact(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-ways-to-choose-coprime-integers-from-rows',
    'related_session' => 'count-ways-to-choose-coprime-integers-from-rows',
];
