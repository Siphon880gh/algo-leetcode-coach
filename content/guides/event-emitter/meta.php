<?php
declare(strict_types=1);

return [
    'title' => 'Event Emitter: per-event lists, unsubscribe removes one',
    'leetcode' => 2694,
    'difficulty' => 'Med',
    'summary' => 'Keep a map from event name to an ordered list of callbacks. subscribe appends and returns an object whose unsubscribe removes that callback; emit calls each in order and returns their results.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'event-emitter',
];
