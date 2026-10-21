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
            'message' => "Problem: Problem: Design a stack with push(x), pop(), top(), peekMax(), and popMax(), where popMax removes the largest value, taking the one nearest the top when there are ties. (Restated from memory; limits and examples may differ slightly.)\nA stack plus a stack of running maxima. Is popMax fast?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it pops into a buffer and pushes back, O(n)', 'next' => 's2'],
                ['label' => 'Yes, O(1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Running maxima give peekMax in O(1) but cannot remove from the middle.\nStep back to when you assumed O(1).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What lets you remove a node from the middle in O(1)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An array', 'next' => 'wrong_b'],
                ['label' => 'A doubly linked list', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Removing from an array shifts the elements after it.\nStep back to when you used an array.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several copies of the max exist. Which goes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The newest, the one nearest the top', 'next' => 'success'],
                ['label' => 'The oldest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem removes the top-most copy.\nStep back to when you removed the oldest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sorted map plus linked list: O(log n) per operation. push 5, 1, 5; top → 5; popMax → 5; top → 1; peekMax → 5; pop → 1; top → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
