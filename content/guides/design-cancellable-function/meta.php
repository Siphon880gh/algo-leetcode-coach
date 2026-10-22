<?php
declare(strict_types=1);

return [
    'title' => 'Design Cancellable Function: race each promise against cancel',
    'leetcode' => 2650,
    'difficulty' => 'Hard',
    'summary' => 'Drive the generator yourself. Await each yielded promise raced against a cancel promise, send the result back with next, and send any rejection back with throw. The outer promise settles with what the generator returns or throws.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'design-cancellable-function',
];
