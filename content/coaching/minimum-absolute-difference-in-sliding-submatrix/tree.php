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
            'message' => "Read the problem statement above.\nDuplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove them first', 'next' => 's2'],
                ['label' => 'Keep them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → [[1, 0]] instead of [[1, 2]].\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Gap to take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min', 'next' => 'wrong_b'],
                ['label' => 'Smallest gap between sorted neighbours', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [[10]] instead of [[2]].\nStep back to when you used the range.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((m − k + 1)(n − k + 1) · k² log k). Examples → [[2]], [[0, 0]], [[1, 2]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
