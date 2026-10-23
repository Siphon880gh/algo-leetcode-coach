<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Range II: split sorted values into up and down',
    'leetcode' => 910,
    'difficulty' => 'Med',
    'summary' => 'Sort. Some prefix gets +k and the rest −k. For split i: high = max(a[n−1] − k, a[i] + k), low = min(a[0] + k, a[i+1] − k). Best of high − low, or the original range.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-range-ii',
    'related_session' => 'smallest-range-ii',
];
