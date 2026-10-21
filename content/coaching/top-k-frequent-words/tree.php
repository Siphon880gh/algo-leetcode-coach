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
            'message' => "Read the problem statement above.\nHow are ties in frequency broken?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alphabetically smaller word first', 'next' => 's2'],
                ['label' => 'By first appearance in the input', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The problem orders ties lexicographically.\nStep back to when you used input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "With a size-k heap, which word sits at the root?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The best word', 'next' => 'wrong_b'],
                ['label' => 'The worst kept: lowest count, then alphabetically largest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The root is what you evict when the heap grows past k.\nStep back to when you kept the best at the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The heap is popped into a list. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Reverse it, since pops come out worst first', 'next' => 'success'],
                ['label' => 'Return it as is', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer must run from most to least frequent.\nStep back to when you skipped the reverse.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Count plus a size-k heap: O(n log k). [\"i\",\"love\",\"leetcode\",\"i\",\"love\",\"coding\"], k = 2 → [\"i\",\"love\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
