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
            'message' => "Problem: Implement a trie that supports inserting a word (duplicates allowed), counting how many inserted words equal a given word, counting how many start with a given prefix, and erasing one copy of a word (the statement guarantees it is present). For instance, after inserting \"apple\" twice, equal(\"apple\") → 2 and startsWith(\"app\") → 2; after one erase both are 1; after a second erase startsWith(\"app\") → 0. (Restated from memory; limits and examples may differ slightly.)\nPrefix count from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The pass counter at the prefix node', 'next' => 's2'],
                ['label' => 'Count end markers in the subtree', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Walking the subtree is slow; keep a counter.\nStep back to when you walked the subtree.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Erase how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Delete the nodes', 'next' => 'wrong_b'],
                ['label' => 'Decrement pass along the path and end at the last node', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Other words may share the path.\nStep back to when you deleted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Missing path in a query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Raise an error', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A missing path just means no such words.\nStep back to when you raised.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|w|) per operation. Constructed check → 2, 2, 1, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
