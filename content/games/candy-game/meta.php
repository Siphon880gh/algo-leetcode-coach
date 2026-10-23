<?php
declare(strict_types=1);

return [
    'title' => 'Candy: left pass, then right pass',
    'leetcode' => 135,
    'difficulty' => 'Hard',
    'summary' => 'Give everyone 1. Left to right: if rating rises, candy[i] = candy[i−1] + 1. Right to left: if rating[i] > rating[i+1], candy[i] = max(candy[i], candy[i+1] + 1). Sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'candy',
    'related_session' => 'candy',
];
