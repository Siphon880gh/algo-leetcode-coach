<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Meeting Earnings with Idle Gaps',
    'leetcode' => 4068,
    'difficulty' => 'Hard',
    'summary' => 'Idle pay telescopes: chaining meeting A then B earns start_B − end_A. Sort by end. For meeting i, val = revenue (start fresh) or revenue + start + the best (val − end) among meetings ending by its start. The answer is the largest val.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-meeting-earnings-with-idle-gaps',
    'related_session' => 'maximize-meeting-earnings-with-idle-gaps',
];
