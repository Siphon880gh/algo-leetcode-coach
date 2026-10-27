<?php
declare(strict_types=1);

return [
    'title' => 'Number of Alternating XOR Partitions',
    'leetcode' => 3811,
    'difficulty' => 'Med',
    'summary' => 'With prefix XOR P, a block (j, i] has XOR P[i] ⊕ P[j]. f[i] = partitions of the prefix ending in a target1 block, g[i] = ending in target2. Hash maps keyed by P[j] give f[i] = (start or g-ways at P[i]⊕t1) and g[i] = f-ways at P[i]⊕t2.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-alternating-xor-partitions',
    'related_session' => 'number-of-alternating-xor-partitions',
];
