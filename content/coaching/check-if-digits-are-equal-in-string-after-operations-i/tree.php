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
            'message' => "Read the problem statement above.\nCompare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The final two digits', 'next' => 's2'],
                ['label' => 'The original first and last', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 3902 → false instead of true.\nStep back to when you compared the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Without mod', 'next' => 'wrong_b'],
                ['label' => 'Mod 10', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 3902 ends as 21 and 11 → false instead of true.\nStep back to when you dropped the mod.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
