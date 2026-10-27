<?php
declare(strict_types=1);

return [
    'title' => 'Widest Possible Fence',
    'leetcode' => 4007,
    'difficulty' => 'Hard',
    'summary' => 'Try every candidate height H: each plank on its own, and each sum of two planks. For H, the width is the count of planks equal to H plus the most disjoint pairs summing to H, which a value-count map gives as the sum of min(c[v], c[H − v]) over v < H − v plus half of c[H divided by 2], rounded down.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'widest-possible-fence',
    'related_session' => 'widest-possible-fence',
];
