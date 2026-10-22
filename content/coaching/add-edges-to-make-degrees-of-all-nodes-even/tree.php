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
            'message' => "Read the problem statement above.\nTwo odd nodes that are already adjacent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Look for a third node adjacent to neither', 'next' => 's2'],
                ['label' => 'Return false', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Two new edges through that node fix both; n = 3, edges [[1,2]] → false instead of true.\nStep back to when you gave up.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Four odd nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try only (a,b)(c,d) in sorted order', 'next' => 'wrong_b'],
                ['label' => 'Try all three pairings', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 pairs 1 – 2 and 3 – 4, which are both edges already, so it → false instead of true.\nStep back to when you tried one pairing.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
