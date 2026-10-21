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
                ['label' => 'Work with |num| and add the sign at the end', 'next' => 's2'],
                ['label' => 'Run % 7 and / 7 on the signed number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In many languages, a negative % 7 gives a negative digit (or a positive one in Python with floor division that never ends at 0).\nStep back to when you used the signed value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Digits come out from num % 7.\nWhich order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Most significant first, keep the order', 'next' => 'wrong_b'],
                ['label' => 'Least significant first, so reverse at the end', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. % 7 gives the least significant digit first. 100 gives 2, 0, 2: palindromic here, but 8 gives 1, 1 and 9 gives 2, 1 → \"12\".\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Loop while n > 0: append n % 7, n //= 7. Reverse, then prefix \"-\" if num < 0. O(log num).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Abs value, reverse digits, sign, and 0 → "0"', 'next' => 'success'],
                ['label' => 'No special case for 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With num = 0 the loop never runs and returns \"\".\nStep back to when you skipped the zero case.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Digits of |num| reversed, sign added, zero handled. 100 → \"202\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
