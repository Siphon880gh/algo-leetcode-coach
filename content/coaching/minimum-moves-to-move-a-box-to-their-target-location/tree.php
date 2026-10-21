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
            'message' => "Read the problem statement above.\nWhat does BFS count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pushes only', 'next' => 's2'],
                ['label' => 'Every player step', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Walking is free; only pushes cost.\nStep back to when you counted steps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Before pushing the box right, the player must?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stand anywhere', 'next' => 'wrong_b'],
                ['label' => 'Reach the cell to its left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A push needs the player behind the box.\nStep back to when you skipped the reach test.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "In the reach test, the box is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An obstacle', 'next' => 'success'],
                ['label' => 'Walkable', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The player cannot walk through the box.\nStep back to when you ignored the box.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 3, −1, and 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
