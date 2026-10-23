<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Books You Can Take: strictly fewer to the left',
    'leetcode' => 2355,
    'difficulty' => 'Hard',
    'summary' => 'End at shelf r taking books[r]; moving left, each shelf takes min(books[i], previous − 1) and stops at 0. (A monotonic stack makes this O(n).)',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-number-of-books-you-can-take',
    'related_session' => 'maximum-number-of-books-you-can-take',
];
