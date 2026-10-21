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
            'message' => "Read the problem statement above.\nToppings per type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0, 1 or 2', 'next' => 's2'],
                ['label' => 'Unlimited', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. At most two of each type are allowed.\nStep back to when you allowed more.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie between costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Take the higher', 'next' => 'wrong_b'],
                ['label' => 'Take the lower', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for the lower one.\nStep back to when you took the higher.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Prune when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Cost ≥ target', 'next' => 'success'],
                ['label' => 'Never', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Adding more only moves further away.\nStep back to when you never pruned.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 3^m). Examples → 10, 17, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
