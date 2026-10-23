<?php
declare(strict_types=1);

return [
    'title' => 'Time Needed to Rearrange a Binary String: ones wait in line',
    'leetcode' => 2380,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right counting zeros. Each 1 with zeros before it needs time = max(previous time + 1, zeros) (it either waits behind the previous 1 or walks past all zeros).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'time-needed-to-rearrange-a-binary-string',
    'related_session' => 'time-needed-to-rearrange-a-binary-string',
];
