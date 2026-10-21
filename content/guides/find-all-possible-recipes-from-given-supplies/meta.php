<?php
declare(strict_types=1);

return [
    'title' => 'Find All Possible Recipes from Given Supplies: Kahn\'s algorithm',
    'leetcode' => 2115,
    'difficulty' => 'Med',
    'summary' => 'Each recipe waits on its ingredients. Start a queue with the supplies; each time an item becomes available, decrement the recipes that need it, and a recipe whose count reaches 0 becomes available too.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'topological-sort', 'hash-table', 'leetcode'],
    'related_session' => 'find-all-possible-recipes-from-given-supplies',
];
