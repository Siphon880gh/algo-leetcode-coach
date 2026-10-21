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
            'message' => "Read the problem statement above.\nWhat do you binary search?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cap x on products per store', 'next' => 's2'],
                ['label' => 'How many stores to use', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer is a product count; for a fixed cap the stores needed follow directly.\nStep back to when you searched stores.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stores needed for q products at cap x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'floor(q / x)', 'next' => 'wrong_b'],
                ['label' => 'ceil(q / x)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. q = 11, x = 3 needs 4 stores, not 3.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Can a store hold two product types?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, at most one type', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each store gets at most one product type, which is why each type needs its own stores.\nStep back to when you mixed types.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log max). Examples → 3, 5, 100000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
