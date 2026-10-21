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
            'message' => "Read the problem statement above.\nQuick infeasibility test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Some value occurs more than k times', 'next' => 's2'],
                ['label' => 'n not divisible by k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Divisibility is guaranteed.\nStep back to when you checked divisibility.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Avoid counting group orders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divide by k! at the end', 'next' => 'wrong_b'],
                ['label' => 'Next group must contain the lowest free index', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. This is a min, not a count; just restrict choices.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Group cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min of a distinct-value subset', 'next' => 'success'],
                ['label' => 'Sum of the subset', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Incompatibility is the range.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → 4, 6, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
