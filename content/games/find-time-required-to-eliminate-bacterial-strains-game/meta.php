<?php
declare(strict_types=1);

return [
    'title' => 'Find Time Required to Eliminate Bacterial Strains: merge the two smallest',
    'leetcode' => 3506,
    'difficulty' => 'Hard',
    'summary' => 'Think backwards: the last split joins two groups and costs splitTime plus the slower group. Like Huffman coding, keep merging the two smallest times a and b (a at most b) into b plus splitTime.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['mini-game', 'leetcode', 'greedy'],
    'entry' => 'index.html',
    'related_guide' => 'find-time-required-to-eliminate-bacterial-strains',
    'related_session' => 'find-time-required-to-eliminate-bacterial-strains',
];
