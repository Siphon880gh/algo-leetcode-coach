<?php
declare(strict_types=1);

return [
    'title' => 'Find All Possible Recipes',
    'leetcode' => 2115,
    'difficulty' => 'Med',
    'summary' => 'Kahn\'s algorithm: each recipe waits on its missing ingredients. Start from supplies; when an item becomes available, decrement recipes that need it; a recipe at 0 becomes available.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-all-possible-recipes-from-given-supplies',
    'related_session' => 'find-all-possible-recipes-from-given-supplies',
];
