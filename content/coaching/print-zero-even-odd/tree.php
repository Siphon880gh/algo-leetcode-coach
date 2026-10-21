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
            'message' => "Read the problem statement above.\nWho decides whose turn is next?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The zero thread, by the parity of i', 'next' => 's2'],
                ['label' => 'The odd and even threads between themselves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every number must follow a 0.\nStep back to when the workers coordinated directly.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After printing its number, the odd thread releases?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'even\'s semaphore', 'next' => 'wrong_b'],
                ['label' => 'zero\'s semaphore', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 0 must come next.\nStep back to when you released even.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many times does the even thread loop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n // 2', 'next' => 'success'],
                ['label' => 'n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It would wait forever for turns that never come.\nStep back to when you looped n times.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 2 → \"0102\". n = 5 → \"0102030405\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
