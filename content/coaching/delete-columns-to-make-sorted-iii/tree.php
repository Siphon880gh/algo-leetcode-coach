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
            'message' => "Read the problem statement above.\nWhat does each row need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To be non-decreasing on its own', 'next' => 's2'],
                ['label' => 'To be ≤ the next row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is part II; here each row is checked by itself.\nStep back to when you compared rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When can column i come before column j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first row agrees', 'next' => 'wrong_b'],
                ['label' => 'Every row has strs[r][i] ≤ strs[r][j]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. All rows must agree.\nStep back to when you used one row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm − (the longest such chain)', 'next' => 'success'],
                ['label' => 'The longest chain', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The question asks how many columns to delete.\nStep back to when you returned the kept count.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m² · n). [\"babca\",\"bbazb\"] → 3. [\"edcba\"] → 4. [\"ghi\",\"def\",\"abc\"] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
