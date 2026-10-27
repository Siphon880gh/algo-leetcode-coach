<?php
declare(strict_types=1);

return [
    'title' => 'Kth Smallest Path XOR Sum',
    'leetcode' => 3590,
    'difficulty' => 'Hard',
    'summary' => 'px[u] = px[parent] XOR vals[u] from the root down. For a query (u, k), collect the distinct px values in u\'s subtree (small-to-large merging of sorted sets) and take the k-th smallest, or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'kth-smallest-path-xor-sum',
    'related_session' => 'kth-smallest-path-xor-sum',
];
