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
            'message' => "Read the problem statement above.\nTrace each bounce?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: unfold the room so the ray is straight', 'next' => 's2'],
                ['label' => 'Yes, reflect step by step', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Unfolding turns the path into a straight line.\nStep back to when you traced bounces.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At what height does the straight ray first reach a corner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p · q', 'next' => 'wrong_b'],
                ['label' => 'L = lcm(p, q)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. p · q may not be the first corner.\nStep back to when you used p · q.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which receptor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L/p even → 0; else L/q even → 2; else 1', 'next' => 'success'],
                ['label' => 'Always 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The parities of the unfoldings decide the corner.\nStep back to when you answered 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log min(p, q)). p = 2, q = 1 → 2. p = 3, q = 1 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
