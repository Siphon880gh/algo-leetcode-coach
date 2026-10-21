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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divisors pair up: i and num / i, one of them ≤ sqrt(num)', 'next' => 's2'],
                ['label' => 'Test every i from 1 to num − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Up to 1e8 divisions per call. Wasteful.\nStep back to when you looped to num − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "i divides num.\nWhat do you add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always i and num / i', 'next' => 'wrong_b'],
                ['label' => 'i and num / i, but only i when i × i == num', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. When i × i == num, i and num / i are the same divisor. Adding both counts it twice.\nStep back to when you always added both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Start s = 1, loop i from 2 while i × i <= num. Return s == num. O(sqrt(num)).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum pairs up to sqrt, s starts at 1, num = 1 → false', 'next' => 'success'],
                ['label' => 'No special case for num = 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. num = 1 has no proper divisors; starting s at 1 would make it equal itself.\nStep back to when you returned true for 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Divisor pairs up to sqrt, careful with squares and 1. 28 → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
