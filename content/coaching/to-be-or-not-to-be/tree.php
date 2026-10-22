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
            'message' => "Read the problem statement above.\nCompare with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '===', 'next' => 's2'],
                ['label' => '==', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. == converts types; in Node expect(5).toBe('5') → true instead of throwing.\nStep back to when you used ==.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A failed check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return false', 'next' => 'wrong_b'],
                ['label' => 'Throw an Error with the message', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The caller expects an error; example 2 → {value: false} instead of {error: Not Equal}.\nStep back to when you returned false.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples (run in Node) → {value: true}, {error: Not Equal}, {value: true}.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
