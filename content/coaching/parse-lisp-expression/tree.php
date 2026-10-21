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
            'message' => "Read the problem statement above.\nOne global variable map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: each let opens a new scope that is discarded afterward', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Inner bindings would leak into outer expressions.\nStep back to when you used one map.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inside a let, a variable name is followed by \")\". What is it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A variable to assign', 'next' => 'wrong_b'],
                ['label' => 'The final expression, so evaluate it', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A name followed by \")\" is the body of the let.\nStep back to when you assigned it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A variable is looked up. Where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The innermost scope that defines it', 'next' => 'success'],
                ['label' => 'The outermost scope', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Inner bindings shadow outer ones.\nStep back to when you looked outermost.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Recursive evaluation with scopes. \"(let x 2 (mult x (let x 3 y 4 (add x y))))\" → 14. \"(let x 3 x 2 x)\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
