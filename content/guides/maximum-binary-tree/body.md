## Recursion, then the stack

**Recursive:** the maximum of `nums[l..r]` is the root; build the left part from the values before it and the right part from the values after it. That is O(n²) on sorted input.

**Monotonic stack, O(n):** scan left to right, keeping a stack of nodes with decreasing values.

1. Make a node for `x`. Pop every node smaller than `x`; the last popped one becomes `x.left`.
2. If the stack is not empty, `x` becomes the top's `right` child.
3. Push `x`.

The bottom of the stack is the root. Each value's parent is the smaller of the nearest greater values on its left and right, and the stack finds both as it goes.

Do not attach every popped node to `x`; only the last one popped (the largest smaller value) is its direct left child. Do not use recursion for very skewed input if the stack depth matters.

Time: O(n) with the stack, O(n²) worst case recursively  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
