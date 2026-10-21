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
            'message' => "Read the problem statement above.\nWhat identifies a Fibonacci-like subsequence?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its last two numbers', 'next' => 's2'],
                ['label' => 'Its last number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. One number does not fix the step back to the one before.\nStep back to when you used one number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For the pair (i, j), which element comes before?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[i] − 1', 'next' => 'wrong_b'],
                ['label' => 'arr[j] − arr[i], if it exists and is less than arr[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each element is the sum of the two before it.\nStep back to when you guessed arr[i] − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The best length found is 2. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A Fibonacci-like sequence needs at least 3 numbers.\nStep back to when you returned 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [1,2,3,4,5,6,7,8] → 5. [1,3,7,11,12,14,18] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
