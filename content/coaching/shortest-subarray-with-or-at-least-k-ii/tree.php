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
            'message' => "Read the problem statement above.\nRemove the left element by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per-bit counts', 'next' => 's2'],
                ['label' => 'XOR', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. XOR does not undo OR: [1, 1, 2] with k = 3 → 3 instead of 2.\nStep back to when you used XOR.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shrink while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR ≥ k', 'next' => 'wrong_b'],
                ['label' => 'OR ≥ k and l ≤ r', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With k = 0 the empty window passes: example 3 → 0 instead of 1.\nStep back to when you dropped l ≤ r.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(30 n). Examples → 1, 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
