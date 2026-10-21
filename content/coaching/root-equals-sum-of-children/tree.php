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
            'message' => "Read the problem statement above.\nCondition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'root = left + right', 'next' => 's2'],
                ['label' => 'root > left and root > right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 [5,3,1] → true instead of false.\nStep back to when you compared sizes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine the children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product', 'next' => 'wrong_b'],
                ['label' => 'Sum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1: 4 · 6 = 24, so → false instead of true.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of the children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Either: addition is symmetric', 'next' => 'success'],
                ['label' => 'left − right', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1: 4 − 6 = −2, so → false instead of true.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
