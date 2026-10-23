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
            'message' => "Read the problem statement above.\nReach nums[j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Subset-sum bitset', 'next' => 's2'],
                ['label' => 'Subtract greedily when it fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums = [5], queries = [[0, 0, 3], [0, 0, 4], [0, 0, 4], [0, 0, 1]] → −1 instead of 4.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums[j] = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Needs one covering query', 'next' => 'wrong_b'],
                ['label' => 'Needs no query', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. nums = [0], queries = [[0, 0, 1]] → 1 instead of 0.\nStep back to when you required a query.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · q · max). Examples → 2, −1, 4, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
