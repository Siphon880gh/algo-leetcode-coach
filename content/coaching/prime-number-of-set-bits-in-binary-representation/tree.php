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
            'message' => "Read the problem statement above.\nHow large can the popcount be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most 20, since numbers are ≤ 10⁶', 'next' => 's2'],
                ['label' => 'Up to 32, so test primality generally', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 10⁶ < 2²⁰, so popcounts are small.\nStep back to when you planned a general test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which popcounts count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1, 2, 3, 5, 7, 11, 13, 17, 19', 'next' => 'wrong_b'],
                ['label' => '2, 3, 5, 7, 11, 13, 17, 19', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 1 is not prime.\nStep back to when you included 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you get the popcount fast?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A built-in, or x &= x − 1 in a loop', 'next' => 'success'],
                ['label' => 'Convert to a string and count characters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That works but is slower; bit tricks are direct.\nStep back to when you used strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(right − left). left = 6, right = 10 → 4. left = 10, right = 15 → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
