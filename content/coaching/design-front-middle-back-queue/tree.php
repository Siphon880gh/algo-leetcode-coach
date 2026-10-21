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
            'message' => "Read the problem statement above.\nMiddle with even length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The front middle: left\'s back', 'next' => 's2'],
                ['label' => 'The back middle', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement uses the frontmost middle.\nStep back to when you took the back one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After each push or pop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only on middle operations', 'next' => 'wrong_b'],
                ['label' => 'Rebalance', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Front and back operations shift the balance too.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Empty queue pop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Raise an error', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement returns −1.\nStep back to when you raised.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per operation. Example pops → 1, 3, 4, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
