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
            'message' => "Read the problem statement above.\nTake the largest square greedily?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: check every square', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The best move depends on the replies.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'true', 'next' => 'wrong_b'],
                ['label' => 'false (the player to move loses)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With no stones, you cannot move.\nStep back to when you set true.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Win condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Some move leads to a losing state', 'next' => 'success'],
                ['label' => 'All moves lead to losing states', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One good move suffices.\nStep back to when you required all.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n √n). n = 1 → true. n = 2 → false. n = 4 → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
