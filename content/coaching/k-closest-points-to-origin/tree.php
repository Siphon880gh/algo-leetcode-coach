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
            'message' => "Read the problem statement above.\nCompute the real distance with a square root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: squared distance gives the same order', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It costs time and adds rounding for nothing.\nStep back to when you took roots.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which heap keeps the k closest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A min-heap of size k', 'next' => 'wrong_b'],
                ['label' => 'A max-heap of size k, popping the farthest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A min-heap of size k would throw away the closest points.\nStep back to when you used a min-heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Must the answer be sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: any order is accepted', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem accepts the k points in any order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log k). [[1,3],[−2,2]], k = 1 → [[−2,2]]. [[3,3],[5,−1],[−2,4]], k = 2 → [[3,3],[−2,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
