<?php
declare(strict_types=1);

return [
    'title' => 'Hash Optimization: Two Sum in One Pass',
    'summary' => 'Replace the inner loop with a hash map from value to index. At index i, compute need = target − nums[i]. If need is in the map, the pair is found; otherwise store nums[i] and move on. O(n) time for O(n) memory.',
    'category' => 'Data Structures',
    'subcategory' => 'Hash Table',
    'topic' => 'Data Structures · Hash Table',
    'tags' => ['hash', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'hash-optimization-strategy',
    'related_session' => 'hash-optimization-strategy',
];
