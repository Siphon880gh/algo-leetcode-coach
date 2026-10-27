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
            'message' => "Read the problem statement above.\nNegating x inside a subarray changes its sum by how much?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−x', 'next' => 'wrong_a'],
                ['label' => '−2x', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x becomes −x, so the sum drops by 2x. In Example 1, 7 becomes 7 − 4 = 3.\nStep back to when you subtracted x once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For one version of the array, how do you find the longest subarray with sum divisible by k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Store the last index of each prefix remainder', 'next' => 'wrong_b'],
                ['label' => 'Store the first index of each prefix remainder', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A later left end only makes the subarray shorter. Keep the first index.\nStep back to when you kept the last index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. n + 1 scans with first prefix remainders. O(n²). Examples give 3, 2 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
