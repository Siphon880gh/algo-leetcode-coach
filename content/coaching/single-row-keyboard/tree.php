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
            'message' => "Problem: A keyboard is one row of the 26 lowercase letters in some order. The finger starts at index 0, and moving from index i to j takes |i − j|. Return the time to type a word. For instance, with the alphabet in order, \"cba\" takes 4. (Restated from memory; limits and examples may differ slightly.)\nFind each letter by scanning the keyboard?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a 26-entry index map', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Build the map once.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Starting position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first letter of the word', 'next' => 'wrong_b'],
                ['label' => 'Index 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The finger starts at index 0.\nStep back to when you started at the word.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cost of a move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|pos[c] − cur|', 'next' => 'success'],
                ['label' => 'pos[c] − cur', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Moving left costs too.\nStep back to when you dropped the absolute value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(len(word)). Alphabet in order, \"cba\" → 2 + 1 + 1 = 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
