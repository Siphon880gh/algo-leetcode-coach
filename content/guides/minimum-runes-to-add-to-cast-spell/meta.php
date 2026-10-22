<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Runes to Add to Cast Spell: source components without a crystal',
    'leetcode' => 3383,
    'difficulty' => 'Hard',
    'summary' => 'Condense the graph into strongly connected components. A source component (no edges coming in) with no crystal can only be reached through a new edge, and one edge from a crystal fixes it, so the answer is the number of such components.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'depth-first-search', 'breadth-first-search', 'topological-sort', 'array', 'leetcode'],
    'related_session' => 'minimum-runes-to-add-to-cast-spell',
];
