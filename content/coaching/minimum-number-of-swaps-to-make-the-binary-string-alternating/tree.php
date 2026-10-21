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
            'message' => "Read the problem statement above.\nCounts differ by 2 or more?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 's2'],
                ['label' => 'Try anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. No alternating string has those counts.\nStep back to when you tried.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Swaps for a pattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mismatches', 'next' => 'wrong_b'],
                ['label' => 'Mismatches / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One swap fixes two mismatched positions.\nStep back to when you counted each.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try both patterns', 'next' => 'success'],
                ['label' => 'Only the one starting with 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Starting with 1 may need fewer swaps.\nStep back to when you tried one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 0, -1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
