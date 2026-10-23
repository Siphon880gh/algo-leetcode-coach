<?php
declare(strict_types=1);

return [
    'title' => 'Count Winning Sequences: Bob\'s last move and the score gap',
    'leetcode' => 3320,
    'difficulty' => 'Hard',
    'summary' => 'dp[last][diff] = Bob sequences so far ending in creature last with (Bob − Alice) = diff. Bob never repeats a creature in consecutive rounds. Count sequences with diff > 0 at the end.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-winning-sequences',
    'related_session' => 'count-the-number-of-winning-sequences',
];
