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
            'message' => "Read the problem statement above.\nHow far does the ball move on turn i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i · k places', 'next' => 's2'],
                ['label' => 'k places every turn', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The step grows each turn; example 1 with k each time → [] instead of [4, 5].\nStep back to when you used a fixed step.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Friend 1 at the start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unmarked until passed to', 'next' => 'wrong_b'],
                ['label' => 'Already had the ball, mark it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Friend 1 starts with the ball; n = 5, k = 1 → [1, 3, 5] instead of [3, 5].\nStep back to when you left friend 1 unmarked.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [4,5], [2,3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
