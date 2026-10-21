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
            'message' => "Read the problem statement above.\nMax moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(s[n−1] − s[1], s[n−2] − s[0]) − n + 2', 'next' => 's2'],
                ['label' => 's[n−1] − s[0] − n + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first move gives up one end gap.\nStep back to when you kept both ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Min: window holds k stones. Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The empty slots in the window', 'next' => 'wrong_b'],
                ['label' => 'n − k', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each stone outside the window must move in.\nStep back to when you counted empty slots.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "n − 1 stones packed tight, one far away. Cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 'success'],
                ['label' => '1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An end stone cannot land right next to the block.\nStep back to when you said 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [7,4,9] → [1,2]. [6,5,4,3,10] → [2,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
