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
            'message' => "Read the problem statement above.\nThe cost comes from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'stones[i] − stones[i − 2]', 'next' => 's2'],
                ['label' => 'The largest adjacent gap', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The frog cannot use every stone both ways; Example 1 → 3 instead of 5.\nStep back to when you used adjacent gaps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "With only two stones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the gaps for i ≥ 2', 'next' => 'wrong_b'],
                ['label' => 'Include stones[1] − stones[0]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. There are none; stones = [0,3] → 0 instead of 3.\nStep back to when you dropped the first gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
