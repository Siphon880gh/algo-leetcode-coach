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
            'message' => "Read the problem statement above.\nChoose the dispenser how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try both with the DP', 'next' => 's2'],
                ['label' => 'The one that frees up first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): demand = [1, 6, 3], fuel = [7, 1] → 1 instead of 0.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare options by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller wait first', 'next' => 'wrong_b'],
                ['label' => 'More cars served, then smaller wait', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): demand = [1, 3, 1], fuel = [2, 3] → 0 instead of 1, serving 1 car instead of 3.\nStep back to when you put the wait first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · F · D). Examples → 6, 0, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
