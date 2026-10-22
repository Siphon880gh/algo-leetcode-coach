<?php
declare(strict_types=1);

return [
    'title' => 'Make Object Immutable: a recursive Proxy that throws',
    'leetcode' => 2692,
    'difficulty' => 'Med',
    'summary' => 'Wrap with a Proxy whose set trap throws the right message, objects and arrays alike. The get trap wraps nested objects on the way out and replaces mutating array methods with functions that throw.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'make-object-immutable',
];
