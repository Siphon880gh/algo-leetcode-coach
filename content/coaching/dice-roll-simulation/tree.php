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
            'message' => "Read the problem statement above.\nState?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(last face, current run length)', 'next' => 's2'],
                ['label' => 'Last face only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The limit depends on the run length.\nStep back to when you dropped the run length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "new[j][1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Total of all sequences', 'next' => 'wrong_b'],
                ['label' => 'Total of all sequences not ending in j', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ending in j already would extend the run.\nStep back to when you included j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Extend run k of face j when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k + 1 ≤ rollMax[j]', 'next' => 'success'],
                ['label' => 'Always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That breaks the consecutive limit.\nStep back to when you always extended.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 6 · 15). n = 2, [1,1,2,2,2,3] → 34. n = 2, [1,1,1,1,1,1] → 30. n = 3, [1,1,1,2,2,3] → 181.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
