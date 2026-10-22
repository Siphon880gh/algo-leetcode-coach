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
            'message' => "Read the problem statement above.\nRemove falsy array elements by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Building a new filtered array', 'next' => 's2'],
                ['label' => 'Deleting their indices', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. delete leaves holes; in Node [null, 0, false, 1] → [null, null, null, 1] as JSON.\nStep back to when you deleted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A child that becomes empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop it', 'next' => 'wrong_b'],
                ['label' => 'Keep it, it is truthy', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An empty array is not falsy; example 3 → [5, [16]] instead of [5, [], [16]].\nStep back to when you dropped empty children.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total size). Examples (run in Node) → [1], {b: [1]}, [5, [], [16]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
