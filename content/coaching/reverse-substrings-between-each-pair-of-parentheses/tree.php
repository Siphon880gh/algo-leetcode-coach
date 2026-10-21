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
            'message' => "Read the problem statement above.\nReverse which pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every pair, innermost to outermost', 'next' => 's2'],
                ['label' => 'Only the innermost', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each pair reverses its contents.\nStep back to when you reversed one pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a parenthesis during the walk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Output it', 'next' => 'wrong_b'],
                ['label' => 'Jump to its partner and reverse direction', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Parentheses are not in the result.\nStep back to when you output it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Aiming for O(n). Method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use the jump walk; the buffer method is O(n²)', 'next' => 'success'],
                ['label' => 'Reverse the buffer at each )', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong for O(n). Reversing at each ) repeats work, though it passes for n ≤ 2000.\nStep back to when you reversed at each ).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"(abcd)\" → \"dcba\". \"(u(love)i)\" → \"iloveu\". \"(ed(et(oc))el)\" → \"leetcode\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
