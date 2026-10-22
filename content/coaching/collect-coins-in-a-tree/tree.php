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
            'message' => "Read the problem statement above.\nFirst step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strip coinless leaves until none remain', 'next' => 's2'],
                ['label' => 'Remove two layers of leaves right away', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Empty branches would still be walked; coins = [1,0,0,1,1,0], edges = [[0,1],[1,2],[2,3],[3,4],[0,5]] → 2 instead of 0.\nStep back to when you skipped the stripping.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many leaf layers to remove next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One', 'next' => 'wrong_b'],
                ['label' => 'Two', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Coins are collected from distance 2; Example 1 → 6 instead of 2.\nStep back to when you removed one layer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
