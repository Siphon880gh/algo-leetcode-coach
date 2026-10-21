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
            'message' => "Read the problem statement above.\nDo you need the length first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a fast pointer at double speed finds the middle in one pass', 'next' => 's2'],
                ['label' => 'Yes, always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Counting works but takes two passes.\nStep back to when you counted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'While fast.next and fast.next.next are not null', 'next' => 'wrong_b'],
                ['label' => 'While fast and fast.next are not null', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That stops one step early and gives the first middle on even lengths.\nStep back to when you checked two ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Six nodes. Which one is returned?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Node 4, the second middle', 'next' => 'success'],
                ['label' => 'Node 3', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem asks for the second middle.\nStep back to when you took node 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [1,2,3,4,5] → [3,4,5]. [1,2,3,4,5,6] → [4,5,6].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
