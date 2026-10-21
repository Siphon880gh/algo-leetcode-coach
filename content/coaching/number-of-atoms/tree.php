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
            'message' => "Read the problem statement above.\nHow do you read an element name?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An uppercase letter followed by any lowercase letters', 'next' => 's2'],
                ['label' => 'Each letter is its own element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Mg is magnesium, not M and g.\nStep back to when you split letters.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\")\" is followed by a number. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply only the last element', 'next' => 'wrong_b'],
                ['label' => 'Pop the counter, multiply every count by that number, merge into the counter below', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The multiplier applies to everything in the parentheses.\nStep back to when you multiplied one element.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "An element ends with count 1. Output?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The name alone, without "1"', 'next' => 'success'],
                ['label' => 'The name followed by 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Count 1 is written without a number.\nStep back to when you wrote 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Stack of counters, sorted output. \"H2O\" → \"H2O\". \"Mg(OH)2\" → \"H2MgO2\". \"K4(ON(SO3)2)2\" → \"K4N2O14S4\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
