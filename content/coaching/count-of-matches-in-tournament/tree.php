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
            'message' => "Read the problem statement above.\nOdd number of teams?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One advances without playing', 'next' => 's2'],
                ['label' => 'Add an extra match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Byes are not matches.\nStep back to when you added one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shortcut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 2 per round, always', 'next' => 'wrong_b'],
                ['label' => 'One loser per match → n − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Round sizes shrink and byes vary.\nStep back to when you fixed n / 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simulation check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add n // 2, set n = (n + 1) // 2', 'next' => 'success'],
                ['label' => 'Add n, halve n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only pairs play.\nStep back to when you added n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). n = 7 → 6. n = 14 → 13.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
