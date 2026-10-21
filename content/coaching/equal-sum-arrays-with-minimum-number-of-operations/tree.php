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
            'message' => "Read the problem statement above.\nGain from an element of the smaller-sum array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '6 − x (raise it)', 'next' => 's2'],
                ['label' => 'x − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Raising the smaller sum closes the gap.\nStep back to when you lowered it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of gains?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest first', 'next' => 'wrong_b'],
                ['label' => 'Largest first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fewest operations means biggest steps first.\nStep back to when you went small first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Overshoot the gap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine: the last change can be smaller', 'next' => 'success'],
                ['label' => 'Not allowed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any value 1 … 6 is allowed, so you can land exactly.\nStep back to when you forbade overshoot.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m) with counts. Examples → 3, −1, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
