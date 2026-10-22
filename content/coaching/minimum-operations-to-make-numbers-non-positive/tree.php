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
            'message' => "Problem: You get an array nums and two integers x and y, with x larger than y. In one operation you choose an index, subtract x from that element and subtract y from every other element. Return the fewest operations that make every element zero or less. The exact limits are in the official statement. For instance, nums = [5, 2], x = 3, y = 1 needs 2 operations: choose index 0 both times. (Restated from memory; limits and examples may differ slightly.)\nFor a guess t, how many picks does v need?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ceil((v − t · y) / (x − y)) when positive', 'next' => 's2'],
                ['label' => 'ceil(v / x)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That ignores the y every operation takes; [5, 2] with x = 3, y = 1 → 3 instead of 2.\nStep back to when you divided by x.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When is t enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each element’s picks are at most t', 'next' => 'wrong_b'],
                ['label' => 'The total picks are at most t', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each operation picks one index; [6, 6, 1] with x = 4, y = 1 → 2 instead of 3.\nStep back to when you checked each element alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). Constructed checks → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
