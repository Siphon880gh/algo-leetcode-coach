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
            'message' => "Read the problem statement above.\nAfter printing, wake whom?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'notify_all', 'next' => 's2'],
                ['label' => 'notify (one thread)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The woken thread may not own the next number, and everything stalls.\nStep back to when you used notify.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How does a thread finish?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop n times', 'next' => 'wrong_b'],
                ['label' => 'Return once i > n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each thread prints a different number of tokens.\nStep back to when you looped n times.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Number thread's test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i % 3 != 0 and i % 5 != 0', 'next' => 'success'],
                ['label' => 'i % 15 != 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Multiples of 3 or 5 belong to other threads.\nStep back to when you only excluded 15.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 15 → 1, 2, fizz, 4, buzz, …, 14, fizzbuzz.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
