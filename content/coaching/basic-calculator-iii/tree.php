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
            'message' => "Problem: Problem: Evaluate an expression string with non-negative integers, + - * /, and parentheses; division truncates toward zero. No built-in eval. (Restated from memory; limits and examples may differ slightly.)\nEvaluate strictly left to right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: * and / bind tighter than + and −', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 2+3*4 is 14, not 20.\nStep back to when you went left to right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The pending operator is *. What do you do with num?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push num', 'next' => 'wrong_b'],
                ['label' => 'Replace the stack top with top · num', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Multiplication must happen before the final sum.\nStep back to when you pushed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You hit \"(\". Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Recurse and use the returned value as the current number', 'next' => 'success'],
                ['label' => 'Push the "(" on the stack', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That works with extra bookkeeping; recursion treats the group as one number directly.\nStep back to when you pushed the parenthesis.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"2*(5+5*2)/3+(6/2+8)\" → 21. \"6-4/2\" → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
