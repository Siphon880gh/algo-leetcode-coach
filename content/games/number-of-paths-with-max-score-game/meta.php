<?php
declare(strict_types=1);

return [
    'title' => 'Number of Paths with Max Score: best score and its count',
    'leetcode' => 1301,
    'difficulty' => 'Hard',
    'summary' => 'From S (bottom-right) move up, left or up-left to E, avoiding X. For each cell keep (best score, ways). Take the best of the three neighbors toward S, summing the ways of all tied neighbors.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-paths-with-max-score',
    'related_session' => 'number-of-paths-with-max-score',
];
