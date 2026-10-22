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
            'message' => "Read the problem statement above.\nMinimise?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unsafe cells on the path', 'next' => 's2'],
                ['label' => 'Number of moves', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → false instead of true: the shortest route crosses unsafe cells.\nStep back to when you minimised moves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Free', 'next' => 'wrong_b'],
                ['label' => 'Counts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In example 3 the border route then leaves health 1, though the statement says it drops to 0.\nStep back to when you skipped the start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
