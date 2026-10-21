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
            'message' => "Problem: Given an infix expression of single-digit operands, +, −, *, / and parentheses, build a binary expression tree whose in-order traversal reproduces the expression without parentheses and which evaluates in the usual order (precedence and left to right). For instance, 3*4-2*5 builds root − with children 3*4 and 2*5. (Restated from memory; limits and examples may differ slightly.)\nPop condition for an operator?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top precedence ≥ current', 'next' => 's2'],
                ['label' => 'Top precedence > current', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal precedence must group left to right.\nStep back to when you used >.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On \")\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push it', 'next' => 'wrong_b'],
                ['label' => 'Combine until "(" then discard it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Parentheses never become tree nodes.\nStep back to when you pushed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Combine order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop right first, then left', 'next' => 'success'],
                ['label' => 'Pop left first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The stack top is the right operand.\nStep back to when you popped left first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). 3*4-2*5 → root − with 3*4 and 2*5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
