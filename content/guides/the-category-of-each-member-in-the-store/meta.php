<?php
declare(strict_types=1);

return [
    'title' => 'The Category of Each Member in the Store: conversion rate bands',
    'leetcode' => 2051,
    'difficulty' => 'Med',
    'summary' => 'LEFT JOIN members → visits → purchases, GROUP BY member, and use CASE on COUNT(visits) = 0 and on 100.0 · COUNT(purchases) / COUNT(visits) against the statement\'s bands.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'joins', 'leetcode'],
    'related_session' => 'the-category-of-each-member-in-the-store',
];
