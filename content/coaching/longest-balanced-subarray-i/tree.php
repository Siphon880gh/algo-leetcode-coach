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
            'message' => "Read the problem statement above.\nWhat to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct evens and distinct odds', 'next' => 's2'],
                ['label' => 'All evens and all odds, repeats included', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 4 instead of 5.\nStep back to when you counted repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sets for each start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them across starts', 'next' => 'wrong_b'],
                ['label' => 'Start fresh for each start', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 2 instead of 3.\nStep back to when you kept the sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 4, 5, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
