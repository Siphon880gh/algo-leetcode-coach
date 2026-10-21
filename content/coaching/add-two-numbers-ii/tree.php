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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push each list onto a stack so you can pop digits from the right', 'next' => 's2'],
                ['label' => 'Convert both lists to integers, add, and convert back', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 100 digits overflow 64-bit integers.\nStep back to when you converted to numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pop a digit from each stack (0 if empty), add carry. Make a node for sum % 10.\nWhere does the new node go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the tail of the result list', 'next' => 'wrong_b'],
                ['label' => 'At the front: node.next = head; head = node', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You produce digits from the ones place up. Appending puts them in reverse order, and then you need a reverse anyway.\nStep back to when you appended the node at the tail.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Loop while either stack has digits or carry is nonzero, so [5] + [5] → [1,0]. O(m + n) time and space. Add Two Numbers (2) stores digits in reverse and walks the lists directly.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stacks, carry, prepend, keep looping while carry. Not 2', 'next' => 'success'],
                ['label' => 'Stop when both stacks are empty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A leftover carry is a real digit. Stopping when both stacks are empty drops it.\nStep back to when you stopped the loop.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Stacks give digits from the right, add with carry, prepend each node, finish the carry. [7,2,4,3] + [5,6,4] → [7,8,0,7].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
