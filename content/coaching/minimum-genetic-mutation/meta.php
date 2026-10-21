<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Genetic Mutation: BFS one letter at a time',
    'leetcode' => 433,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: fewest one-letter mutations from startGene to endGene, each intermediate gene in bank. BFS from start over bank genes at Hamming distance 1, marking visited. Unreachable → −1. AACCGGTT → AACCGGTA with bank [AACCGGTA] → 1. Not 127. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'BFS',
    'topic' => 'LeetCode · BFS',
    'tags' => ['bfs', 'strings', 'hash-table', 'step-by-step'],
    'related_guide' => 'minimum-genetic-mutation',
];
