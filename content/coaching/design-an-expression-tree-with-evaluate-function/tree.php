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
            'message' => "Problem: Given the postfix tokens of an arithmetic expression (integers and the operators +, −, *, /), build an expression tree whose nodes expose an evaluate method, with division and other details as the statement specifies. For instance, [\"3\",\"4\",\"+\",\"2\",\"*\"] builds (3 + 4) * 2, which evaluates to 14. (Restated from memory; limits and examples may differ slightly.)\nPop order on an operator?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Right first, then left', 'next' => 's2'],
                ['label' => 'Left first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The stack top is the right operand.\nStep back to when you popped left first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Class design?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One node with a type switch', 'next' => 'wrong_b'],
                ['label' => 'Leaf and operator node classes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The follow-up wants new operators without editing evaluate.\nStep back to when you used a switch.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The single node left on the stack', 'next' => 'success'],
                ['label' => 'The first node created', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The first node is a leaf.\nStep back to when you returned it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
