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
            'message' => "Read the problem statement above.\nLetter value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ord(c) − ord(\'a\')', 'next' => 's2'],
                ['label' => 'ord(c) − ord(\'a\') + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. a is 0, not 1.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leading zeros like \"aab\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Treat as invalid', 'next' => 'wrong_b'],
                ['label' => 'Drop them: value 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Conversion to an integer ignores them.\nStep back to when you rejected them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Compare how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As integers', 'next' => 'success'],
                ['label' => 'As strings', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. '0' and '0000' are equal numbers.\nStep back to when you compared strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
