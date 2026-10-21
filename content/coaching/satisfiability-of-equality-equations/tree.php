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
            'message' => "Read the problem statement above.\nProcess the equations in input order in one pass?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: apply every "==" before checking any "!="', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. An equality later in the list can connect two variables of an earlier inequality.\nStep back to when you used one pass.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "\"a!=b\" with a and b in the same set. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split the set', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Union-find cannot split, and the equalities force a == b.\nStep back to when you split.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "\"a!=a\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always false: a is in its own set', 'next' => 'success'],
                ['label' => 'Always true', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A variable always equals itself.\nStep back to when you accepted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n α(26)). [\"a==b\",\"b!=a\"] → false. [\"b==a\",\"a==b\"] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
