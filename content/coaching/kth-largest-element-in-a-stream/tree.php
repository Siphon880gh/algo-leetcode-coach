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
            'message' => "Read the problem statement above.\nWhich heap do you keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A min-heap of the k largest values seen', 'next' => 's2'],
                ['label' => 'A max-heap of every value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Then each add needs k pops to find the kth largest.\nStep back to when you kept everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The heap has k + 1 items after a push. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop the maximum', 'next' => 'wrong_b'],
                ['label' => 'Pop the minimum', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The smallest of the k + 1 is no longer among the top k.\nStep back to when you popped the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The constructor gets fewer than k numbers. Problem?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the first add fills the heap to k', 'next' => 'success'],
                ['label' => 'Yes: pad the heap with zeros', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Padding would invent values; the problem guarantees k items when you read the answer.\nStep back to when you padded.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log k) per add. k = 3, [4,5,8,2]: add 3 → 4, add 5 → 5, add 10 → 5, add 9 → 8, add 4 → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
