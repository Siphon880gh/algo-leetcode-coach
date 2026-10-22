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
            'message' => "Read the problem statement above.\nWhere to attach the function on context?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Under a fresh Symbol', 'next' => 's2'],
                ['label' => 'As context.fn', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A string key can clash and shows up; in Node the object’s keys → a, fn instead of a.\nStep back to when you used fn.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the call?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave it', 'next' => 'wrong_b'],
                ['label' => 'Delete the temporary key', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The object is changed; in Node it keeps 1 symbol instead of 0.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) besides fn. Examples (run in Node) → 12, The cost of the burger is 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
