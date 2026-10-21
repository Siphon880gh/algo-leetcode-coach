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
            'message' => "Read the problem statement above.\nFind the leftmost open stack how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A min-heap of open indices', 'next' => 's2'],
                ['label' => 'Scan from 0 each push', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. There can be 10⁵ stacks and 2 · 10⁵ calls.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap top is past the end or full. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use it anyway', 'next' => 'wrong_b'],
                ['label' => 'Pop it and look again', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Stale entries must be skipped.\nStep back to when you used a stale index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "pop() with empty stacks at the right end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove them first', 'next' => 'success'],
                ['label' => 'Return −1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A non-empty stack may sit further left.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) amortised. Example returns 2, 20, 21, 5, 4, 3, 1, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
