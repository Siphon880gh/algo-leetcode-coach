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
            'message' => "Read the problem statement above.\nWhich numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'num + 1 and num + 2', 'next' => 's2'],
                ['label' => 'num and num + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The product must be num + 1 or num + 2.\nStep back to when you used num.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up from 1', 'next' => 'wrong_b'],
                ['label' => 'Down from √x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first divisor below the root is the closest.\nStep back to when you started at 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order of the pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any', 'next' => 'success'],
                ['label' => 'Must be ascending', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any order is accepted.\nStep back to when you forced an order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(√num). 8 → [3,3]. 123 → [5,25]. 999 → [25,40] in any order.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
