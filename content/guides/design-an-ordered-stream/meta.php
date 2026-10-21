<?php
declare(strict_types=1);

return [
    'title' => 'Design an Ordered Stream: pointer sweep',
    'leetcode' => 1656,
    'difficulty' => 'Easy',
    'summary' => 'Store values by id and keep a pointer to the next id to emit. On insert, if the pointer\'s slot is filled, return the run of filled slots starting there and advance the pointer.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'array', 'leetcode'],
    'related_session' => 'design-an-ordered-stream',
];
