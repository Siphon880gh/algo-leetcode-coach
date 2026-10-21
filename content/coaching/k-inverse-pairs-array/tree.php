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
            'message' => "Read the problem statement above.\nGenerate permutations and count their pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP over f[i][j]', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n! is astronomical for n = 1000.\nStep back to when you generated permutations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You insert i into a permutation of 1..i − 1. How many new pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always i − 1', 'next' => 'wrong_b'],
                ['label' => 'Anywhere from 0 to i − 1, depending on the position', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Putting i at the end adds none, and each step to the left adds one.\nStep back to when you fixed the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "f[i][j] = Σ f[i − 1][j − t]. How do you compute it fast?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Slide: f[i][j − 1] + f[i − 1][j] − f[i − 1][j − i]', 'next' => 'success'],
                ['label' => 'Loop over t for every cell', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n² · k); the window sum changes by one term in and one out.\nStep back to when you looped over t.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Window-sum DP mod 1e9 + 7: O(n · k) time, O(k) space. n = 3, k = 1 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
