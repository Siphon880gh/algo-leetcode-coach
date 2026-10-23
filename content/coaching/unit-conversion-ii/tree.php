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
            'message' => "Problem: There are n unit types, 0 … n − 1, and n − 1 conversions; each one says a single unit of a source type equals some integer number of units of a target type, and together they connect every type exactly one way. For each query (a, b), return how many units of b equal one unit of a. The answer can be a fraction p/q, so report it as p · q⁻¹ modulo 10^9 + 7. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nDivide how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply by the modular inverse', 'next' => 's2'],
                ['label' => 'Plain integer division', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. conversions [[0, 1, 3], [1, 2, 4]], queries [[0, 2], [2, 0], [1, 1]] → [12, 0, 1] instead of [12, 83333334, 1].\nStep back to when you divided plainly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walking an edge backwards uses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same factor', 'next' => 'wrong_b'],
                ['label' => 'The inverse of its factor', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. conversions [[1, 0, 3]], query [0, 1] → 3 instead of 333333336 (one third).\nStep back to when you reused the factor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q log M). Checks → [12, 83333334, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
