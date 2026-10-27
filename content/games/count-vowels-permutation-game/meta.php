<?php
declare(strict_types=1);

return [
    'title' => 'Count Vowels Permutation: who may come before each vowel?',
    'leetcode' => 1220,
    'difficulty' => 'Hard',
    'summary' => 'Rules: a to e, e to a|i, i to anything but i, o to i|u, u to a. Count strings ending in each vowel: new[a] = e + i + u, new[e] = a + i, new[i] = e + o, new[o] = i, new[u] = i + o.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-vowels-permutation',
    'related_session' => 'count-vowels-permutation',
];
