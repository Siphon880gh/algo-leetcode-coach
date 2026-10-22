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
            'message' => "Read the problem statement above.\nSeveral callbacks for one event?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them all, in subscription order', 'next' => 's2'],
                ['label' => 'Keep only the latest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. emit must call every one; example 1 → [6] instead of [5, 6].\nStep back to when you replaced the callback.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "unsubscribe removes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every callback of the event', 'next' => 'wrong_b'],
                ['label' => 'Only that callback', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Others must keep firing; two subscribers, cancel the first, emit 5 → [] instead of [7].\nStep back to when you cleared the event.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(listeners) per emit. Examples (run in Node) → as in the guide.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
