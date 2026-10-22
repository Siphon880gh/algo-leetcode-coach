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
            'message' => "Read the problem statement above.\nTwo windows of the same shortest length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the smaller string', 'next' => 's2'],
                ['label' => 'Keep the first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 1101100001 with k = 3 → 1101 instead of 1011.\nStep back to when you kept the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fewer than k ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return s', 'next' => 'wrong_b'],
                ['label' => 'Return the empty string', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No substring has k ones; example 3 → 000 instead of empty.\nStep back to when you returned s.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 11001, 11, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
