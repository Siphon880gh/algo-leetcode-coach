<?php
declare(strict_types=1);

return [
    'title' => 'Average Height of Buildings in Each Segment: sweep events',
    'leetcode' => 2015,
    'difficulty' => 'Med',
    'summary' => 'Turn each building into +height/+1 at start and −height/−1 at end. Sweep sorted positions with a running height sum and count; between consecutive positions with count > 0 emit sum // count, extending the previous segment when it touches and has the same average.',
    'category' => 'LeetCode',
    'subcategory' => 'Sweep Line',
    'topic' => 'LeetCode · Sweep Line',
    'kind' => 'algo',
    'tags' => ['sweep-line', 'sorting', 'hash-table', 'leetcode'],
    'related_session' => 'average-height-of-buildings-in-each-segment',
];
