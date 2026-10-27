<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Jumps to Reach End via Prime Teleportation',
    'leetcode' => 3629,
    'difficulty' => 'Med',
    'summary' => 'BFS over indices. Neighbors are i − 1, i + 1, and — if nums[i] is a prime p — every index whose value is a multiple of p. Use each prime\'s teleport list once, then clear it.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-jumps-to-reach-end-via-prime-teleportation',
    'related_session' => 'minimum-jumps-to-reach-end-via-prime-teleportation',
];
