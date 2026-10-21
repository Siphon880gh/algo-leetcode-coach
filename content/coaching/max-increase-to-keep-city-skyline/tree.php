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
            'message' => "Read the problem statement above.\nWhat limits a building at (r, c)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(rowMax[r], colMax[c])', 'next' => 's2'],
                ['label' => 'The overall maximum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each view has its own maximum for that row or column.\nStep back to when you used the global max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Do the maxima change as you raise buildings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: update them', 'next' => 'wrong_b'],
                ['label' => 'No: no building passes its own caps', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Raising to at most the smaller maximum leaves both skylines the same.\nStep back to when you updated them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The cap minus the current height, for every cell', 'next' => 'success'],
                ['label' => 'The caps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is the total increase.\nStep back to when you summed the caps.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[3,0,8,4],[2,4,5,7],[9,2,6,3],[0,3,1,0]] → 35.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
