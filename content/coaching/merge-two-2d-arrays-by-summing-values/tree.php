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
            'message' => "Read the problem statement above.\nBoth ids are equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One entry with the summed value', 'next' => 's2'],
                ['label' => 'Append both entries', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Each id appears once in the result; Example 1 → [[1,2],[1,4],[2,3],[3,2],[4,5],[4,1]].\nStep back to when you appended both.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One list runs out?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'wrong_b'],
                ['label' => 'Append the rest of the other', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The remaining ids are lost; Example 2 → [[1,3],[2,4],[3,6],[4,3]], missing [5,5].\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [[1,6],[2,3],[3,2],[4,6]], [[1,3],[2,4],[3,6],[4,3],[5,5]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
