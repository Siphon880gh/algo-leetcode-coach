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
            'message' => "Read the problem statement above.\nWhich values matter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts of distinct values only', 'next' => 's2'],
                ['label' => 'Every element separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal values are interchangeable.\nStep back to when you kept elements.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Mask over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct values (≤ 50)', 'next' => 'wrong_b'],
                ['label' => 'Customers (m ≤ 10)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 2^50 states are impossible.\nStep back to when you masked values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Split one customer across values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each customer needs a single integer.\nStep back to when you split.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · 3^m). Examples → false, true, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
