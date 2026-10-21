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
            'message' => "Read the problem statement above.\nWhich side to extend?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger neighbour', 'next' => 's2'],
                ['label' => 'Always the left first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Taking the smaller one lowers the minimum early.\nStep back to when you fixed a side.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One side exhausted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'wrong_b'],
                ['label' => 'Extend the other', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Longer windows may still score more.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Track?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Running minimum and best score', 'next' => 'success'],
                ['label' => 'Only the window length', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The score needs the minimum.\nStep back to when you tracked length only.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 15, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
