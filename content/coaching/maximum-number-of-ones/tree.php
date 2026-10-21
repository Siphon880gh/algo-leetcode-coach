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
            'message' => "Problem: A width × height matrix of 0s and 1s must have at most maxOnes ones in every sideLength × sideLength square. Return the most ones possible. For instance, width = height = 3, sideLength = 2, maxOnes = 1 gives 4. (Restated from memory; limits and examples may differ slightly.)\nPlace 1s greedily cell by cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: choose tile positions', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Early choices block better ones.\nStep back to when you placed cell by cell.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count for tile position (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(width // s) · (height // s)', 'next' => 'wrong_b'],
                ['label' => '((width − i − 1) // s + 1) · ((height − j − 1) // s + 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Partial tiles at the edges count.\nStep back to when you ignored the edges.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which positions get 1s?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The maxOnes with the largest counts', 'next' => 'success'],
                ['label' => 'The first maxOnes positions', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The most frequent positions give the most ones.\nStep back to when you took the first ones.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(s² log s). 3 × 3, side 2, maxOnes 1 → 4. maxOnes 2 → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
