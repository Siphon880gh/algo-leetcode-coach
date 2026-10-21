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
            'message' => "Read the problem statement above.\nEmpty part before the left parenthesis?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat it as 1', 'next' => 's2'],
                ['label' => 'Treat it as 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every placement with an empty side would score 0; Example 3 → (999+999) is a real sum.\nStep back to when you used 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Inside the parentheses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any split, even (+38)', 'next' => 'wrong_b'],
                ['label' => 'At least one digit on each side of +', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. (+38) is not a valid expression.\nStep back to when you allowed an empty side.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Return what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The expression with parentheses', 'next' => 'success'],
                ['label' => 'Its value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 2(47+38), not 170.\nStep back to when you returned the value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|x| · |y| · len). Examples → 2(47+38), 1(2+3)4, (999+999).\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
