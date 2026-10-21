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
            'message' => "Problem: Given an integer array, count the elements x for which x + 1 is also in the array, treating duplicates as the statement specifies (typically each occurrence counts). For instance, [1,2,3] gives 2. (Restated from memory; limits and examples may differ slightly.)\nLookup structure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash set', 'next' => 's2'],
                ['label' => 'Nested loop', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you nested loops.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x − 1', 'next' => 'wrong_b'],
                ['label' => 'x + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The pair goes upward.\nStep back to when you checked x − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you iterate when counting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Iterate the array, not the set', 'next' => 'success'],
                ['label' => 'Iterate the set', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Iterating the set drops duplicate occurrences.\nStep back to when you iterated the set.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
