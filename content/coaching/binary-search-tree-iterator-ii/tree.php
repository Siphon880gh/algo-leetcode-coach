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
            'message' => "Problem: Design an iterator over a BST's in-order sequence with next, hasNext, prev and hasPrev; the pointer starts before the smallest element. For instance, on the BST [7,3,15,null,null,9,20]: next → 3, next → 7, prev → 3, next → 7, next → 9. (Restated from memory; limits and examples may differ slightly.)\nFlatten the whole tree up front?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lazy stack plus a history list', 'next' => 's2'],
                ['label' => 'Must flatten first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Laziness keeps O(h) extra until values are visited.\nStep back to when you flattened everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "next() when idx < len(list) − 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pull from the stack', 'next' => 'wrong_b'],
                ['label' => 'Move idx forward in the list', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After prev, the next values are already cached.\nStep back to when you used the stack.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "hasNext()?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'idx < len − 1 or the stack is non-empty', 'next' => 'success'],
                ['label' => 'Stack non-empty only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Cached values ahead also count.\nStep back to when you checked only the stack.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) amortised per call. The example gives 3, 7, 3, 7, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
