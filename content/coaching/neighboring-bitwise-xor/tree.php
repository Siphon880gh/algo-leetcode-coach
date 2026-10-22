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
            'message' => "Read the problem statement above.\nWhat decides whether an original exists?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR of all derived values is 0', 'next' => 's2'],
                ['label' => 'derived[0] equals the last value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is not the condition; example 1 [1, 1, 0] → false instead of true.\nStep back to when you compared the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always valid', 'next' => 'wrong_b'],
                ['label' => 'Valid only when derived[0] is 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. derived[0] is original[0] XOR itself; [1] → true instead of false.\nStep back to when you accepted every single value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
