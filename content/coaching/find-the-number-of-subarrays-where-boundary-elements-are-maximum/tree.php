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
            'message' => "Read the problem statement above.\nWhich equal pairs count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those with nothing larger between', 'next' => 's2'],
                ['label' => 'Every equal pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3, 4, 3] → 4 instead of 3.\nStep back to when you counted every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pop while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top value ≤ x', 'next' => 'wrong_b'],
                ['label' => 'Top value < x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal values lose their count: example 2 → 3 instead of 6.\nStep back to when you popped equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n); use 64-bit. Examples → 6, 6, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
