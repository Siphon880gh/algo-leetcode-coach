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
            'message' => "Read the problem statement above.\nWhich letter decides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest letter other than a', 'next' => 's2'],
                ['label' => 'The largest letter', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. \"yz\" → 1 instead of 2.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine letters how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add every letter’s distance to a', 'next' => 'wrong_b'],
                ['label' => 'Return 26 − its index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"yz\" → 3 instead of 2.\nStep back to when you added distances.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
