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
            'message' => "Read the problem statement above.\nUse a heap keyed by (count, push time)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It works in O(log n), but stacks per frequency give O(1)', 'next' => 's2'],
                ['label' => 'Yes, it is the only way', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Stacks by frequency level handle both the count and recency.\nStep back to when you reached for a heap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Push x, which now has count 3. Where does it go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move it from stack 2 to stack 3', 'next' => 'wrong_b'],
                ['label' => 'Onto stack 3; its copies on stacks 1 and 2 stay', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The lower copies are needed after later pops.\nStep back to when you moved it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After a pop, stack maxf is empty. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'maxf −= 1', 'next' => 'success'],
                ['label' => 'Scan for the new maximum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The value just popped still sits on stack maxf − 1, so it is non-empty.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per operation. push 5, 7, 5, 7, 4, 5 → pops give 5, 7, 5, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
