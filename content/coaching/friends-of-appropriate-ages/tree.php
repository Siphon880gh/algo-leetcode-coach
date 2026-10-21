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
            'message' => "Read the problem statement above.\nCheck every pair of people?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only 120 ages, so check age pairs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2 · 10⁴ people means 4 · 10⁸ pairs.\nStep back to when you paired people.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does age a send to age b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'b ≥ a', 'next' => 'wrong_b'],
                ['label' => 'b > 0.5 · a + 7 and b ≤ a', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Requests go to people no older than the sender, above a minimum age.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "a == b and the rule allows it. Requests?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[a] · (cnt[a] − 1)', 'next' => 'success'],
                ['label' => 'cnt[a] · cnt[a]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nobody sends a request to themselves.\nStep back to when you counted self-requests.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 120²). [16,16] → 2. [16,17,18] → 2. [20,30,100,110,120] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
