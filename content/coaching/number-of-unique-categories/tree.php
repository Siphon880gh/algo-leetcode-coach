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
            'message' => "Problem: There are n elements, numbered 0 to n − 1, and each belongs to some category. You cannot see the categories; you can only ask a provided object whether two elements are in the same category. Return the number of distinct categories. The method name and limits are in the official statement. For instance, if the hidden categories are [1, 1, 2, 3, 2], the answer is 3. (Restated from memory; limits and examples may differ slightly.)\nCompare element i with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every earlier element', 'next' => 's2'],
                ['label' => 'Only element i − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That counts changes; hidden [1, 2, 1] → 3 instead of 2.\nStep back to when you compared only neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count element i when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Some earlier element matches', 'next' => 'wrong_b'],
                ['label' => 'No earlier element matches', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts repeats; the example → 2 instead of 3.\nStep back to when you counted matches.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) queries. The example → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
