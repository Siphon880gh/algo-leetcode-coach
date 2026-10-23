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
            'message' => "Read the problem statement above.\nRule cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost + number of \'*\'', 'next' => 's2'],
                ['label' => 'cost only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 2 instead of 3.\nStep back to when you left out the '*' surcharge.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Position already matches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A rule must still cover it', 'next' => 'wrong_b'],
                ['label' => 'Skip it for free', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): source = \"ab\", target = \"ac\", rules = [[\"b\", \"c\"]], costs = [1] → −1 instead of 1.\nStep back to when you forced a rule.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · R · L). Examples → 7, 3, 6, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
