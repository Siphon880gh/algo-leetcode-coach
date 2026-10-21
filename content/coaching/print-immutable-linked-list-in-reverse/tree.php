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
            'message' => "Problem: You get the head of an immutable linked list through an interface that can only print the current node or return the next node. Print every value from the tail back to the head without changing the list. (Restated from memory; limits and examples may differ slightly.)\nReverse the list first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it is immutable', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You cannot change the links.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "In the recursion, print when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before it', 'next' => 'wrong_b'],
                ['label' => 'After the recursive call', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Printing first gives head-to-tail order.\nStep back to when you printed first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Base case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A null node: return', 'next' => 'success'],
                ['label' => 'The head', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Recursion stops past the tail.\nStep back to when you stopped at the head.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) time, O(n) stack. For instance, 1 → 2 → 3 prints 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
