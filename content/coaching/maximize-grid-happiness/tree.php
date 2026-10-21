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
            'message' => "Read the problem statement above.\nWhich neighbours to score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up and left only', 'next' => 's2'],
                ['label' => 'All four', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Right and down are scored when those cells are filled.\nStep back to when you used four.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Neighbour adjustment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the new person changes', 'next' => 'wrong_b'],
                ['label' => 'Both people change: −30 introvert, +20 extrovert', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Happiness of the existing neighbour changes too.\nStep back to when you scored one side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Profile size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3^n with n ≤ 5', 'next' => 'success'],
                ['label' => '2^(m·n)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the last n cells affect future scores.\nStep back to when you stored the grid.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 240, 260, 240.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
