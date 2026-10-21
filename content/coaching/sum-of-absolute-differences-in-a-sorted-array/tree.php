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
            'message' => "Read the problem statement above.\nWhy prefix sums work?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sorted order fixes each difference\'s sign', 'next' => 's2'],
                ['label' => 'They always do', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Without sorting, |x − y| has unknown signs.\nStep back to when you ignored order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sumLeft − x · i', 'next' => 'wrong_b'],
                ['label' => 'x · i − sumLeft', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Left values are ≤ x.\nStep back to when you flipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Right part?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sumRight − x · (n − 1 − i)', 'next' => 'success'],
                ['label' => 'x · (n − 1 − i) − sumRight', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Right values are ≥ x.\nStep back to when you flipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,3,5] → [4,3,5]. [1,4,6,8,10] → [24,15,13,15,21].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
