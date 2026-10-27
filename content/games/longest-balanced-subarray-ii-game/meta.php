<?php
declare(strict_types=1);

return [
    'title' => 'Longest Balanced Subarray II',
    'leetcode' => 3721,
    'difficulty' => 'Hard',
    'summary' => 'Sweep the right end. Give each value +1 (odd) or −1 (even) counted only at its latest occurrence; then balance of [l..r] is a suffix sum. A segment tree over l with range add (when a value moves) and "leftmost l with sum 0" finds the longest balanced subarray ending at r.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-balanced-subarray-ii',
    'related_session' => 'longest-balanced-subarray-ii',
];
