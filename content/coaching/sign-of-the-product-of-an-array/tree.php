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
            'message' => "Read the problem statement above.\nCompute the product?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, track signs only', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 100^1000 overflows fixed-size integers.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A zero anywhere?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'wrong_b'],
                ['label' => 'Return 0 immediately', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any zero makes the product 0.\nStep back to when you skipped zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Odd number of negatives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each pair of negatives cancels; one is left over.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 0, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
