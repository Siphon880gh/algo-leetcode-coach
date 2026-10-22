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
            'message' => "Read the problem statement above.\nRecolouring a ball?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decrement its old colour, drop it at 0', 'next' => 's2'],
                ['label' => 'Just add the new colour', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The old colour stays counted: example 1 → [1, 2, 3, 3] instead of [1, 2, 2, 3].\nStep back to when you only added.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Store balls in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An array of size limit + 1', 'next' => 'wrong_b'],
                ['label' => 'A map', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. limit reaches 10^9.\nStep back to when you used an array.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q). Examples → [1, 2, 2, 3], [1, 2, 2, 3, 4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
