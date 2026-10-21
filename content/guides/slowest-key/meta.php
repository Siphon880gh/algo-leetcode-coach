<?php
declare(strict_types=1);

return [
    'title' => 'Slowest Key: max duration, ties by larger letter',
    'leetcode' => 1629,
    'difficulty' => 'Easy',
    'summary' => 'Duration of key i is releaseTimes[i] − releaseTimes[i − 1] (the first is releaseTimes[0]). Keep the maximum (duration, key) pair, so ties go to the lexicographically larger letter.',
    'category' => 'LeetCode',
    'subcategory' => 'Array',
    'topic' => 'LeetCode · Array',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'leetcode'],
    'related_session' => 'slowest-key',
];
