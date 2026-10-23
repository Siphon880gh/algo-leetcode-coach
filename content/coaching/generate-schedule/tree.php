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
            'message' => "Read the problem statement above.\nWhich n have no schedule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every n below 5', 'next' => 's2'],
                ['label' => 'Only n below 3', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A search over every order finds no schedule for n = 4.\nStep back to when you allowed n = 4.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Order the match pool how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'For each d, i in plain order', 'next' => 'wrong_b'],
                ['label' => 'For each d, even i first, then odd i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The greedy gets stuck at n = 6.\nStep back to when you used plain order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Checked valid for n = 5 … 50 in the guide.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
