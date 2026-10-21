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
            'message' => "Problem: Given a binary array, return the minimum number of swaps to make all its 1s adjacent anywhere in the array. For instance, [1,0,1,0,1] needs 1 swap and [0,0,0,1,0] needs 0. (Restated from memory; limits and examples may differ slightly.)\nWindow length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k, the number of 1s', 'next' => 's2'],
                ['label' => 'Variable, grown until it holds every 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The final block has exactly k cells.\nStep back to when you let it grow.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Swaps for a window holding m ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total distance of the 1s to it', 'next' => 'wrong_b'],
                ['label' => 'k − m', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One swap moves a 1 any distance.\nStep back to when you summed distances.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k is 0. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'success'],
                ['label' => '−1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. There is nothing to group.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,1,0,1] → 1. [0,0,0,1,0] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
