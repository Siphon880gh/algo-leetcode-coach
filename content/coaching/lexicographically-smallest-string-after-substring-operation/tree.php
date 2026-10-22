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
            'message' => "Read the problem statement above.\nWhere does the decremented run end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just before the next a', 'next' => 's2'],
                ['label' => 'At the end of the string', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An a would wrap to z; example 1 → bazab instead of baabc.\nStep back to when you ran to the end.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Every letter is a?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Change the first letter to z', 'next' => 'wrong_b'],
                ['label' => 'Change the last letter to z', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A z at the front is the worst place; example 2 → za instead of az.\nStep back to when you changed the first letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → baabc, az, abaab, kddsbncd.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
