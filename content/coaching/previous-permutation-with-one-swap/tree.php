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
            'message' => "Read the problem statement above.\nWhich position changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last i with arr[i] > arr[i + 1]', 'next' => 's2'],
                ['label' => 'The first such i', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Changing further left makes the result smaller than needed.\nStep back to when you took the first descent.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Swap arr[i] with which value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest value to its right', 'next' => 'wrong_b'],
                ['label' => 'The largest value to its right that is below arr[i]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That drops the permutation more than necessary.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "That value appears several times. Which copy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 'success'],
                ['label' => 'The rightmost', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The leftmost keeps the result larger.\nStep back to when you took the rightmost.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,2,1] → [3,1,2]. [1,1,5] → [1,1,5]. [1,9,4,6,7] → [1,7,4,6,9].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
