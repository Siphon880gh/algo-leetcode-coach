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
            'message' => "Read the problem statement above.\nScores to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All three first-move sums', 'next' => 's2'],
                ['label' => 'Only the first two elements', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2, 3, 1, 2] → 1 instead of 2 (both ends first, score 4).\nStep back to when you fixed the score.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Choose moves by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first move that fits', 'next' => 'wrong_b'],
                ['label' => 'Memoized DP over (left, right)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2, 4, 1, 1, 2, 3] → 1 instead of 2.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
