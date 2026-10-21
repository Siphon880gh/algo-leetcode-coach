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
            'message' => "Read the problem statement above.\nFirst pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two largest', 'next' => 's2'],
                ['label' => 'Largest and smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That shrinks the product you subtract from.\nStep back to when you mixed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Second pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Next two largest', 'next' => 'wrong_b'],
                ['label' => 'Two smallest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You want the smallest product to subtract.\nStep back to when you used large values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Negatives to worry about?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, all values are positive', 'next' => 'success'],
                ['label' => 'Yes, check sign cases', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The constraints give values ≥ 1.\nStep back to when you added sign cases.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 34, 64.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
