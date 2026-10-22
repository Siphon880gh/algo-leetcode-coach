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
            'message' => "Read the problem statement above.\nHow may the digits of i² be cut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Into any number of pieces', 'next' => 's2'],
                ['label' => 'Into exactly two pieces', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 36 needs 1 + 29 + 6; n = 37 → 182 instead of 1478.\nStep back to when you allowed one cut.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For each good i, add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i', 'next' => 'wrong_b'],
                ['label' => 'i²', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The punishment number sums squares; n = 10 → 20 instead of 182.\nStep back to when you added i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 2^d). Examples → 182, 1478.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
