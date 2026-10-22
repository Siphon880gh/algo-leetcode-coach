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
            'message' => "Problem: Write a generator over an array that starts at a given index and yields the element there. Each value passed into next moves the index by that many steps around the array, wrapping in both directions, and the generator then yields the new element. The exact signature and limits are in the official statement. For instance, with [1, 2, 3, 4, 5] starting at index 0, jumps 1, 2, 6 and −6 yield 1, then 2, 4, 5 and 4. (Restated from memory; limits and examples may differ slightly.)\nMove the index with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '((i + j) % n + n) % n', 'next' => 's2'],
                ['label' => '(i + j) % n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. JavaScript’s % can be negative; in Node jump −2 from index 0 yields undefined instead of 4.\nStep back to when you used plain %.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A jump past the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clamp to the last index', 'next' => 'wrong_b'],
                ['label' => 'Wrap around', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The array is circular; in Node jump 2 from index 4 of [1, 2, 3, 4, 5] → 5 instead of 2.\nStep back to when you clamped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per step. The example → 1, 2, 4, 5, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
