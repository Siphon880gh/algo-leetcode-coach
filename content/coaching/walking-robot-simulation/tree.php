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
            'message' => "Read the problem statement above.\nCommand −2 (turn left) with direction index d in (N, E, S, W). New d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(d + 3) % 4', 'next' => 's2'],
                ['label' => '(d + 1) % 4', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. +1 turns right.\nStep back to when you turned right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Command 4. Move how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Jump 4 squares, then check', 'next' => 'wrong_b'],
                ['label' => 'One square at a time, stopping before an obstacle', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You could jump past an obstacle.\nStep back to when you jumped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest x² + y² during the walk', 'next' => 'success'],
                ['label' => 'The final x² + y²', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The robot can wander far and come back.\nStep back to when you used the final position.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(commands · 9 + obstacles). [4,−1,3], [] → 25. [4,−1,4,−2,4], [[2,4]] → 65. [6,−1,−1,6], [] → 36.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
