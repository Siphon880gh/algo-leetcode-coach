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
            'message' => "Read the problem statement above.\nRecord the current number’s first digit when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'After counting its pairs', 'next' => 's2'],
                ['label' => 'Before', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It then pairs with itself; example 1 → 6 instead of 5.\nStep back to when you recorded first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare which digits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Last of the earlier, first of the later', 'next' => 'wrong_b'],
                ['label' => 'First digit of the earlier, last digit of the later', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The order is fixed by i < j; example 2 → 3 instead of 2.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(9n). Examples → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
