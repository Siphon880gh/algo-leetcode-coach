<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: up to 1000 unique lowercase words, all length n (1 to 4). Return every word square: row k equals column k. A word may repeat. [\"area\",\"lead\",\"wall\",\"lady\",\"ball\"] → two squares, starting with ball and wall. (Restated from memory; limits and examples may differ slightly.)\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Backtrack row by row, and pick the next row by the prefix the column forces', 'next' => 's2'],
                ['label' => 'Try every n-tuple of words and check each one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 1000^4 is 1e12 tuples. You need to prune by what the earlier rows already force.\nStep back to when you tried all tuples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rows so far: ball, area. Column 2 reads l, e. So row 2 must start with \"le\".\nHow do you find words with that prefix fast?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan the whole word list each time and test startswith', 'next' => 'wrong_b'],
                ['label' => 'A trie whose nodes store the indexes of words with that prefix', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Scanning all 1000 words at every step multiplies the cost at every level.\nStep back to when you scanned the whole list.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When the path has n rows, save a copy. Otherwise get the forced prefix, try each candidate, push, recurse, pop. Reuse is allowed, so do not mark words used. Valid Word Square (422) only checks one square.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trie of prefixes, backtrack by column prefix, reuse allowed. Not 422', 'next' => 'success'],
                ['label' => 'Mark each word used so it appears at most once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement allows the same word more than once. [\"abat\",\"baba\",\"atan\",\"atal\"] has squares that use baba twice.\nStep back to when you banned reuse.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Column prefix decides the next row, a trie hands you the candidates, reuse is fine. [\"area\",\"lead\",\"wall\",\"lady\",\"ball\"] → two squares.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
