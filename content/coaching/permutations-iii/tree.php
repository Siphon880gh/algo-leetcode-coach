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
            'message' => "Problem: Given n, list every permutation of 1 … n in which each pair of neighbors has one odd and one even number, in lexicographic order. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nFirst number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any', 'next' => 's2'],
                ['label' => 'Odd only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 4 → 4 instead of 8.\nStep back to when you forced odd.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Parity against?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first element', 'next' => 'wrong_b'],
                ['label' => 'The last element', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n = 4 → 0 instead of 8.\nStep back to when you compared with the first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · output). The guide’s checks → 2, 8, 12, 28,800.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
