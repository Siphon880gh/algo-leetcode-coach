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
            'message' => "Read the problem statement above.\nNew remainder after digit d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(10r + d) mod m', 'next' => 's2'],
                ['label' => '(r + d) mod m', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Appending a digit multiplies by 10; Example 2 → [0,0,0,0] instead of [0,1,0,1].\nStep back to when you dropped the 10.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order of digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the right', 'next' => 'wrong_b'],
                ['label' => 'From the left', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That tests suffixes, not prefixes; Example 2 → [1,0,1,0] instead of [0,1,0,1].\nStep back to when you reversed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,1,0,0,0,1,1,0,0], [0,1,0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
