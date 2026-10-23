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
            'message' => "Read the problem statement above.\nPositions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1-based', 'next' => 's2'],
                ['label' => '0-based', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. abc → 73 instead of 148.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Letter value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'c − a + 1', 'next' => 'wrong_b'],
                ['label' => '26 − (c − a)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. abc → 14 instead of 148.\nStep back to when you used the forward alphabet.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 148, 160.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
