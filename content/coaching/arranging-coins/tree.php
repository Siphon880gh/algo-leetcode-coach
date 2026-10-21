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
                ['label' => 'Find the largest k with k(k + 1) / 2 <= n', 'next' => 's2'],
                ['label' => 'Return the number of rows used, including the partial one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counting the partial row gives 3 for n = 5, but row 3 only has 2 of its 3 coins.\nStep back to when you counted the partial row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k(k + 1) / 2 grows with k, so binary search k in [0, n].\nWhat about the multiplication?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain 32-bit ints are fine', 'next' => 'wrong_b'],
                ['label' => 'Do it in 64 bits', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With k near 2^31, k(k + 1) overflows 32 bits and the comparison lies.\nStep back to when you used 32-bit math.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Closed form k = floor((sqrt(8n + 1) − 1) / 2) is O(1) but can be off by one with floats; recheck with integers. Sqrt(x) (69) is the same search for squares.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search in 64 bits, or the formula with an integer check. Not 69', 'next' => 'success'],
                ['label' => 'Use the float formula and return it as is', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Simulating row by row is O(sqrt n), about 65 000 steps here. It passes, but the binary search or the checked formula is the expected approach, and a float formula without a recheck can be off by one.\nStep back to when you trusted the raw float formula.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Largest k with k(k + 1) / 2 <= n, computed in 64 bits. n = 5 → 2, n = 8 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
