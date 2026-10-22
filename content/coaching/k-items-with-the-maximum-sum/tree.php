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
            'message' => "Read the problem statement above.\nAnswer is just min(k, numOnes)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, subtract forced −1s', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Once 1s and 0s run out you must take −1s; numOnes = 3, numZeros = 2, numNegOnes = 1, k = 6 → 3 instead of 2.\nStep back to when you ignored the −1s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many −1s are forced?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(0, k − numOnes)', 'next' => 'wrong_b'],
                ['label' => 'max(0, k − numOnes − numZeros)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zeros are taken before −1s; Example 2 → 2 instead of 3.\nStep back to when you skipped the zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
