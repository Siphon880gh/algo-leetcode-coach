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
            'message' => "Read the problem statement above.\nTry every parenthesization?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: look at what can make the value largest', 'next' => 's2'],
                ['label' => 'Yes: interval DP over every split', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It works, but every value is at least 2, so a direct formula gives the best answer.\nStep back to when you reached for DP.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a is always on top, b always below. What about c … z?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them below: a / b / c / … / z', 'next' => 'wrong_b'],
                ['label' => 'Put them all on top: a / (b / c / … / z)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each of c … z then divides the result again and makes it smaller.\nStep back to when you left them below.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What about n = 1 and n = 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return "a" and "a/b" with no parentheses', 'next' => 'success'],
                ['label' => 'Always wrap the rest in parentheses', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With two numbers, parentheses around b are redundant, and the answer must not have redundant parentheses.\nStep back to when you always wrapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. a/(b/c/…/z) for n ≥ 3, plain strings for n ≤ 2: O(n) time. [1000,100,10,2] → \"1000/(100/10/2)\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
