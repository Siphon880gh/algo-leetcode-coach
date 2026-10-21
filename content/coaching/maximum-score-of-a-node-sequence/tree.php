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
            'message' => "Read the problem statement above.\nEnumerate what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The middle edge (b, c)', 'next' => 's2'],
                ['label' => 'Every path of four nodes by DFS', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A dense graph has far too many such paths.\nStep back to when you searched every path.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Neighbours to keep per node?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the best one', 'next' => 'wrong_b'],
                ['label' => 'The best three', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best neighbour can be the other middle node; Example 1 → −1 instead of 24.\nStep back to when you kept one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Distinctness check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of a, b, c, d', 'next' => 'success'],
                ['label' => 'Only a ≠ d', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. a could equal c; Example 1 → 34 instead of 24.\nStep back to when you checked only a and d.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(E log E). Examples → 24, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
