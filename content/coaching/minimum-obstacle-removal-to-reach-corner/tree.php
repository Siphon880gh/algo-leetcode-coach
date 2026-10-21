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
            'message' => "Read the problem statement above.\nMinimise what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Obstacles entered', 'next' => 's2'],
                ['label' => 'Steps taken', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Plain BFS gives the path length; Example 1 → 4 instead of 2.\nStep back to when you counted steps.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only right and down', 'next' => 'wrong_b'],
                ['label' => 'Up, down, left and right', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2’s free path goes back up; → 1 instead of 0.\nStep back to when you allowed only two directions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Initial distance of other cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Infinity', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Nothing can improve on 0; Example 1 → 0 instead of 2.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
