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
            'message' => "Read the problem statement above.\nHow much does a term x^i cost in operators?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i (and 2 for x^0 = x / x)', 'next' => 's2'],
                ['label' => 'Always 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. x^3 = x * x * x needs two multiplications plus a sign.\nStep back to when you charged 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A digit d at power i can be built how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only by adding d copies', 'next' => 'wrong_b'],
                ['label' => 'Add d copies, or subtract x − d copies and carry 1 upward', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Overshooting and subtracting is sometimes cheaper.\nStep back to when you only added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why subtract 1 at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first term needs no leading sign', 'next' => 'success'],
                ['label' => 'To undo the carry', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each term was charged a sign, but the first one has none.\nStep back to when you blamed the carry.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log_x target). x = 3, target = 19 → 5. x = 5, target = 501 → 8. x = 100, target = 100000000 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
