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
            'message' => "Read the problem statement above.\nWhich stored intervals to merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any that overlap, including one starting before left', 'next' => 's2'],
                ['label' => 'Only those starting at or after left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. add(1,5) then add(3,7) → 10 instead of 7.\nStep back to when you ignored the earlier start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update the total how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just add the new interval’s length', 'next' => 'wrong_b'],
                ['label' => 'Subtract each merged interval, then add the new one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Overlaps count twice; add(2,3), add(7,10), add(5,8) → 10 instead of 8.\nStep back to when you skipped the subtraction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integers in [l, r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r − l + 1', 'next' => 'success'],
                ['label' => 'r − l', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The example → 4 instead of 6 after two adds.\nStep back to when you used r − l.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) amortised add, O(1) count. Example → 6, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
