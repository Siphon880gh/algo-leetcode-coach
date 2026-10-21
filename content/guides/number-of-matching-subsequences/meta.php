<?php
declare(strict_types=1);

return [
    'title' => 'Number of Matching Subsequences: advance every word in one pass',
    'leetcode' => 792,
    'difficulty' => 'Med',
    'summary' => 'Bucket the words by the next letter they are waiting for. Scan s once; for each letter, take that bucket and move each word to the bucket of its following letter, counting it when it finishes.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Map',
    'topic' => 'LeetCode · Hash Map',
    'kind' => 'algo',
    'tags' => ['hash-map', 'strings', 'binary-search', 'leetcode'],
    'related_session' => 'number-of-matching-subsequences',
];
