<?php
declare(strict_types=1);

return [
    'title' => 'Partition Labels: stretch to the last occurrence',
    'leetcode' => 763,
    'difficulty' => 'Med',
    'summary' => 'Precompute each letter\'s last index. Walk the string with end = max(end, last[ch]). When i == end, nothing inside the part appears later: cut here.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'partition-labels',
    'related_session' => 'partition-labels',
];
