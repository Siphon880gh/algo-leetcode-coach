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
            'message' => "Read the problem statement above.\nCheck a piece for apples?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(1) with suffix sums', 'next' => 's2'],
                ['label' => 'Scan the piece', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Scanning multiplies the cost.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Base case c = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always 1', 'next' => 'wrong_b'],
                ['label' => '1 if the remainder has an apple', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last piece also needs an apple.\nStep back to when you returned 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which part is given away?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Top (horizontal) or left (vertical)', 'next' => 'success'],
                ['label' => 'Either side', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement fixes which side leaves.\nStep back to when you chose freely.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [\"A..\",\"AAA\",\"...\"], k = 3 → 3. [\"A..\",\"AA.\",\"...\"], k = 3 → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
