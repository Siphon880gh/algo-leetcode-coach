<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Swap: swap with the last larger digit to the right',
    'leetcode' => 670,
    'difficulty' => 'Med',
    'summary' => 'Record the last position of each digit. Scan from the left; at the first position where some larger digit appears later, swap it with the last occurrence of the largest such digit.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'math', 'arrays', 'leetcode'],
    'related_session' => 'maximum-swap',
];
