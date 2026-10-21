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
            'message' => "Problem: You play levels in order and level i costs damage[i] health. Once in the whole game you may use armor on one level, reducing that level’s damage by up to armor. Your health must stay greater than 0 at all times. Return the minimum starting health needed to finish. For instance, [2,7,4,3] with armor 4 → 13; [2,5,3,4] with armor 7 → 10; [3,3,3] with armor 0 → 10. (Restated from memory; limits and examples may differ slightly.)\nWhere to use the armor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On the largest damage', 'next' => 's2'],
                ['label' => 'On the first level', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [2,7,4,3] with armor 4 → 15 instead of 13.\nStep back to when you used it first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How much does it block?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'armor', 'next' => 'wrong_b'],
                ['label' => 'min(max damage, armor)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2,5,3,4] with armor 7 → 8 instead of 10; it cannot block more than the hit.\nStep back to when you subtracted the full armor.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final + 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: health must stay above 0', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. [2,7,4,3] with armor 4 → 12 would end at 0 health.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed cases → 13, 10, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
