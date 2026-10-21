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
            'message' => "Read the problem statement above.\nFreed seats stored in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A min-heap', 'next' => 's2'],
                ['label' => 'A stack', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A stack returns the most recent, not the smallest.\nStep back to when you used a stack.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap empty on reserve?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan for the smallest free seat', 'next' => 'wrong_b'],
                ['label' => 'Return next and increment', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every unseen seat is larger than next − 1.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Heap vs next priority?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Heap first; its values are all below next', 'next' => 'success'],
                ['label' => 'Compare each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Freed seats were handed out earlier, so they are smaller.\nStep back to when you compared.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per call. Example → 1, 2, 2, 3, 4, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
