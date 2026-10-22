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
            'message' => "Read the problem statement above.\nCharacter i becomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's[(i + k) mod n]', 'next' => 's2'],
                ['label' => 's[(i − k) mod n]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → artd instead of tdar.\nStep back to when you read behind.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shift what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letters in the alphabet', 'next' => 'wrong_b'],
                ['label' => 'Positions', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → gduw instead of tdar.\nStep back to when you shifted letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → tdar, aaa.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
