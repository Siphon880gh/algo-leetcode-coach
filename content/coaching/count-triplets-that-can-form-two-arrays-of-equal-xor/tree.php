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
            'message' => "Read the problem statement above.\nLoop over j too?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: every j in (i, k] works', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Once the range XOR is 0, j is free.\nStep back to when you looped j.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Range XOR is 0 when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p[i] == p[k]', 'next' => 'wrong_b'],
                ['label' => 'p[i] == p[k+1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That misses arr[k].\nStep back to when you used p[k].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "O(n)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Per value: count and index sum', 'next' => 'success'],
                ['label' => 'Not possible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counts and sums aggregate the k − i terms.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [2,3,1,6,7] → 4. [1,1,1,1,1] → 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
