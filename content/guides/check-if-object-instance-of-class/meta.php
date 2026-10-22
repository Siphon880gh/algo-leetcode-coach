<?php
declare(strict_types=1);

return [
    'title' => 'Check if Object Instance of Class: walk the prototype chain',
    'leetcode' => 2618,
    'difficulty' => 'Med',
    'summary' => 'Plain instanceof fails for primitives such as 5 and Number. Instead walk Object.getPrototypeOf from the value and compare each link with classFunction.prototype, after ruling out null, undefined and non-function classes.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'check-if-object-instance-of-class',
];
