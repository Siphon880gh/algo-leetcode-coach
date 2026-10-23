<?php
declare(strict_types=1);

return [
    'title' => 'Freedom Trail: cheapest ring position for each key letter',
    'leetcode' => 514,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][p] = fewest rotations to spell key[0..i] with ring position p (holding key[i]) at 12 o\'clock. Moving from q to p costs min(|p−q|, n − |p−q|). Add one press per letter.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'freedom-trail',
    'related_session' => 'freedom-trail',
];
