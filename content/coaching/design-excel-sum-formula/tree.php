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
            'message' => "Problem: Excel(height, width) with set(r, c, v), get(r, c) and sum(r, c, refs), where refs are cells like \"A1\" or ranges like \"A1:B2\". A sum stays live: later changes to its cells change its value, until set overwrites the cell. (Restated from memory; limits and examples may differ slightly.)\nOn sum(), store the computed number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: store the formula, a map from cell to count', 'next' => 's2'],
                ['label' => 'Yes: store the total', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Later set calls on the referenced cells would not show up.\nStep back to when you stored the number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"A1\" and \"A1:B2\" both include A1. How many times does it count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once', 'next' => 'wrong_b'],
                ['label' => 'Twice', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every listed reference is added, so a repeated cell adds twice.\nStep back to when you counted it once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "get on a formula cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ count · get(ref), evaluated recursively', 'next' => 'success'],
                ['label' => 'The value from when sum was called', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The formula is live, so it must use the current values.\nStep back to when you used the stored value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Formulas as reference counts, evaluated on demand, cleared by set: no cycles, so recursion ends.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
