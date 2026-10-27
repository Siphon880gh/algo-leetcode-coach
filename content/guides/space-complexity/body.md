## Tiny example

A function copies an input array of length `n` into a new array, then loops over it.

- The input itself is usually **not** counted as extra space.
- The new array is **O(n)** of extra space.
- A recursion depth of `h` counts as **O(h)** of stack space.

If you only use a few scalar variables, the extra space is **O(1)**.

## How

1. Decide what "extra" means, beyond the input.
2. Add up the arrays and maps you allocate.
3. Add the maximum recursion depth, or the size of any explicit stack.

## Trap

Claiming a recursive DFS uses O(1) space because you did not allocate an array.

**Fix:** The call stack is memory. A depth of h means O(h) space.

**Report:** the extra space as n grows, and mention the stack if the code is recursive.

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
