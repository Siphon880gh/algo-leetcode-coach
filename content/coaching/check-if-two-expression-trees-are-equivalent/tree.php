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
            'message' => "Problem: Given two binary expression trees whose leaves are single-letter variables and whose internal nodes use only the + operator, return true if they evaluate to the same value for every assignment of the variables. For instance, a+(b+c) and (b+c)+a are equivalent; a+b and a+c are not. (Restated from memory; limits and examples may differ slightly.)\nCompare tree shapes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare leaf multisets', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Addition is commutative and associative.\nStep back to when you compared shapes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Repeated letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use a set', 'next' => 'wrong_b'],
                ['label' => 'Count multiplicity', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. a + a differs from a.\nStep back to when you used a set.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Subtraction follow-up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pass a sign down; flip on − right child', 'next' => 'success'],
                ['label' => 'Ignore signs', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. a − b differs from b − a.\nStep back to when you ignored signs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check: a+(b+c) vs (b+c)+a → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
