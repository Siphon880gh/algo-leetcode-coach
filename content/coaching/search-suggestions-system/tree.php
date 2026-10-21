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
            'message' => "Read the problem statement above.\nFirst step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the products', 'next' => 's2'],
                ['label' => 'Build suggestions unsorted', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Suggestions must be the lexicographically smallest.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For each prefix, find?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An exact match', 'next' => 'wrong_b'],
                ['label' => 'The lower bound of the prefix', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Matches share the prefix, not the whole word.\nStep back to when you searched for an exact match.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many to take?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to 3 that start with the prefix', 'next' => 'success'],
                ['label' => 'Exactly 3', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Fewer may match; check each one.\nStep back to when you took 3 blindly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + L · log n). \"mouse\" → first two rows [\"mobile\",\"moneypot\",\"monitor\"], then [\"mouse\",\"mousepad\"] three times.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
