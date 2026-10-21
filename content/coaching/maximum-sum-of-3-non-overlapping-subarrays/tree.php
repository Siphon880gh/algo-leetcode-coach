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
            'message' => "Read the problem statement above.\nTry every triple of windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: fix the middle and look up the best side windows', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n³).\nStep back to when you tried triples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "left[i] = best window index in 0 … i. Tie rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update on ≥', 'next' => 'wrong_b'],
                ['label' => 'Update only on strictly greater, keeping the earlier index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The answer must be lexicographically smallest, so ties keep the earlier start.\nStep back to when you updated on ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "right[i] is built from the end. Tie rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Update on ≥, which also keeps the earlier index', 'next' => 'success'],
                ['label' => 'Update only on strictly greater', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Scanning right to left, ≥ moves to the earlier index on a tie.\nStep back to when you used strictly greater.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Middle j from k to len(W) − 1 − k with left[j − k] and right[j + k]: O(n). [1,2,1,2,6,7,5,1], k = 2 → [0,3,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
