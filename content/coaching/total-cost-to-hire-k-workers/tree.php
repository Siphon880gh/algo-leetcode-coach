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
            'message' => "Read the problem statement above.\nEqual costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smaller index', 'next' => 's2'],
                ['label' => 'The back group first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. costs = [5,1,4,5,2,1], k = 4, candidates = 1 → 12 instead of 9.\nStep back to when you preferred the back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Refill from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the front', 'next' => 'wrong_b'],
                ['label' => 'The side the hired worker came from', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. costs = [5,2,5,3,5,4,1], k = 4, candidates = 1 → 11 instead of 12.\nStep back to when you always refilled the front.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width for the total?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It can reach 10^5 · 10^5 = 10^10.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((candidates + k) log candidates). Examples → 11, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
