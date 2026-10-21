<?php
declare(strict_types=1);

return [
    'title' => 'Avoid Flood in The City: dry the right lake with a sorted set of dry days',
    'leetcode' => 1488,
    'difficulty' => 'Med',
    'summary' => 'Record the last day each lake filled. When it rains on a full lake, use the earliest dry day after that fill to dry it; if none exists, return []. Unused dry days can dry any lake.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'binary-search', 'ordered-set', 'leetcode'],
    'related_session' => 'avoid-flood-in-the-city',
];
