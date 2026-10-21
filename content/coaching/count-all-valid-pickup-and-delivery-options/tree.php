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
            'message' => "Read the problem statement above.\nFactor for order i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i · (2i − 1)', 'next' => 's2'],
                ['label' => '(2i)!', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the new pair is placed at step i.\nStep back to when you used a factorial.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pickup and delivery order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Either order', 'next' => 'wrong_b'],
                ['label' => 'Pickup first only', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Delivery must follow pickup, halving the choices.\nStep back to when you allowed both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every step', 'next' => 'success'],
                ['label' => 'Only at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The product overflows long before the end.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 1 → 1. n = 2 → 6. n = 3 → 90.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
