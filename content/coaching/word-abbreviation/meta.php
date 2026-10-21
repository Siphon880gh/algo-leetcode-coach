<?php
declare(strict_types=1);

return [
    'title' => 'Word Abbreviation: group by (length, first, last), prefix = 1 + longest common prefix',
    'leetcode' => 527,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: shortest unique abbreviations (prefix + count + last letter). Only words with the same length, first and last letter clash; in each group a word needs prefix length 1 + its longest common prefix with any other. Keep the word if not shorter. "internet" → "i6t"; "internal" stays. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'strings', 'sorting', 'greedy', 'step-by-step'],
    'related_guide' => 'word-abbreviation',
];
