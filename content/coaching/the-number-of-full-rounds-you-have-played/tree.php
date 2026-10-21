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
            'message' => "Read the problem statement above.\nLogout earlier than login?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1440 to logout', 'next' => 's2'],
                ['label' => 'Swap them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The session runs past midnight.\nStep back to when you swapped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Rounding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both down', 'next' => 'wrong_b'],
                ['label' => 'Login up, logout down', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A round already under way at login is not full.\nStep back to when you rounded login down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both inside one round?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clamp to 0', 'next' => 'success'],
                ['label' => 'Return the formula as is', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It can come out as −1.\nStep back to when you skipped the clamp.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 1, 22.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
