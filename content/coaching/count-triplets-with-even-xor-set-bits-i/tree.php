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
            'message' => "Problem: Given three integer arrays a, b and c, count the triplets (i, j, k) for which a[i] XOR b[j] XOR c[k] has an even number of set bits. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nTrack per value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Parity of its set bits', 'next' => 's2'],
                ['label' => 'Whether the value is even', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 3 is odd but has two set bits: [3], [1], [1] → 0 instead of 1.\nStep back to when you used the value’s parity.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which parity triples count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All three parities equal', 'next' => 'wrong_b'],
                ['label' => 'An even number of odd parities', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check [1, 1], [2, 3], [1, 5] → 2 instead of 4.\nStep back to when you required equal parities.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). The guide’s checks → 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
