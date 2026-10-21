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
            'message' => "Read the problem statement above.\nWhich token do you play face up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cheapest remaining', 'next' => 's2'],
                ['label' => 'The most expensive you can afford', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every point is worth the same, so spend as little power as possible.\nStep back to when you spent more.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which token do you play face down?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cheapest remaining', 'next' => 'wrong_b'],
                ['label' => 'The most expensive remaining', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A point should buy as much power as possible.\nStep back to when you sold cheap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The best score seen at any time', 'next' => 'success'],
                ['label' => 'The final score', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Trading at the end can lower the score.\nStep back to when you returned the final score.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [100], power 50 → 0. [200,100], power 150 → 1. [100,200,300,400], power 200 → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
