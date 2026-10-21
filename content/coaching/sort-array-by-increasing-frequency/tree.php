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
            'message' => "Read the problem statement above.\nPrimary key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Frequency ascending', 'next' => 's2'],
                ['label' => 'Value ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rarer values come first.\nStep back to when you sorted by value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie-break?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller value first', 'next' => 'wrong_b'],
                ['label' => 'Larger value first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal frequencies go in decreasing order.\nStep back to when you sorted ties ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each value repeated by its count', 'next' => 'success'],
                ['label' => 'Distinct values only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The array keeps all elements.\nStep back to when you deduplicated.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [1,1,2,2,2,3] → [3,1,1,2,2,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
