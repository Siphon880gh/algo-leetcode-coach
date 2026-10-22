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
            'message' => "Read the problem statement above.\nFirst idea?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reserve one 1 for the last digit', 'next' => 's2'],
                ['label' => 'Sort the digits descending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That can end in 0; 010 → 100, which is even.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where do the zeros go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the front', 'next' => 'wrong_b'],
                ['label' => 'Between the leading 1s and the last 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Leading zeros shrink the number; 0101 → 0011 (3) instead of 1001 (9).\nStep back to when you put zeros first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 001, 1001.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
