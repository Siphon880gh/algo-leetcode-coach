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
            'message' => "Read the problem statement above.\nStart time of an order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(clock, arrival)', 'next' => 's2'],
                ['label' => 'arrival', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The chef may still be busy.\nStep back to when you used arrival.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Wait of a customer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'finish − start', 'next' => 'wrong_b'],
                ['label' => 'finish − arrival', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Waiting includes the queue time.\nStep back to when you used start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Reorder customers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: they are served in order', 'next' => 'success'],
                ['label' => 'Sort by prep time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The chef follows input order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5.00000, 3.25000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
