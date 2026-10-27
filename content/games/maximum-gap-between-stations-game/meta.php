<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Gap Between Stations',
    'leetcode' => 4026,
    'difficulty' => 'Med',
    'summary' => 'early[i] = the leftmost station worker i can take when everyone before is placed greedily from the left; late[i] = the rightmost when everyone after is placed greedily from the right. The biggest gap is max over i of late[i] − early[i − 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-gap-between-stations',
    'related_session' => 'maximum-gap-between-stations',
];
