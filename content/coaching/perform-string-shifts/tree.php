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
            'message' => "Problem: Given a string and a list of shifts, each a direction (left or right, encoded as in the statement) and an amount, return the string after all shifts. For instance, \"abc\" shifted left 1 then right 2 gives \"cab\". (Restated from memory; limits and examples may differ slightly.)\nApply each shift?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: net amount', 'next' => 's2'],
                ['label' => 'Yes, one by one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Shifts cancel, and amounts can be large.\nStep back to when you applied each one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negative net?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use it as is', 'next' => 'wrong_b'],
                ['label' => 'Non-negative modulo', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Slicing needs 0 ≤ r < n.\nStep back to when you kept a negative.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Right rotation by r?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's[n−r:] + s[:n−r]', 'next' => 'success'],
                ['label' => 's[r:] + s[:r]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is a left rotation.\nStep back to when you sliced at r.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + shifts). \"abc\", left 1 then right 2 → \"cab\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
