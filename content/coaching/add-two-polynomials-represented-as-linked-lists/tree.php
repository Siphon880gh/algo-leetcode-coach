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
            'message' => "Problem: Each polynomial is a linked list of (coefficient, power) nodes in strictly decreasing power with no zero coefficients. Return their sum in the same form, dropping terms that cancel. For instance, [[5,3],[4,1],[-1,0]] + [[2,2],[-4,1]] → [[5,3],[2,2],[-1,0]]. (Restated from memory; limits and examples may differ slightly.)\nMerge direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Higher power first', 'next' => 's2'],
                ['label' => 'Lower power first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The lists run from high to low power.\nStep back to when you took the lower one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal powers summing to 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep a zero node', 'next' => 'wrong_b'],
                ['label' => 'Skip the term', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zero coefficients are not allowed in the output.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One list ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Append the rest of the other', 'next' => 'success'],
                ['label' => 'Stop', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The remaining terms still belong to the sum.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + n). Constructed check → [[5,3],[2,2],[-1,0]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
