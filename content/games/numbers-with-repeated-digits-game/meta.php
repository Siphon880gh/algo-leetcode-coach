<?php
declare(strict_types=1);

return [
    'title' => 'Numbers With Repeated Digits: count the all-distinct ones instead',
    'leetcode' => 1012,
    'difficulty' => 'Hard',
    'summary' => 'Answer = n − (numbers at most n with all digits distinct). Shorter lengths L: 9 times 9 times 8 times … (L factors). Same length: walk n\'s digits, counting smaller unused choices times permutations of the rest; stop if a digit repeats.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'numbers-with-repeated-digits',
    'related_session' => 'numbers-with-repeated-digits',
];
