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
            'message' => "Read the problem statement above.\nWhen does a refill happen?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the can holds less than the plant needs', 'next' => 's2'],
                ['label' => 'When the can is empty', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A plant must be watered fully, so a short can refills first.\nStep back to when you waited for empty.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do they move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alice first, then Bob', 'next' => 'wrong_b'],
                ['label' => 'Together, one plant each per step', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They start at the same time from opposite ends.\nStep back to when you ran them one after the other.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Both reach the same plant?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The fuller can waters it; Alice on a tie', 'next' => 'success'],
                ['label' => 'Alice always waters it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. plants [1,5,1], capacityA = 2, capacityB = 6: Bob has 5 left and needs no refill, so the answer is 0, not 1.\nStep back to when you gave it to Alice.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
