## Tiny example

Add up the numbers from 1 to n.

Iteratively: start with `s = 0`, then add each `i` from 1 to n. This uses one stack frame, so the extra space is O(1).

Recursively: `sum(n) = n + sum(n-1)`. This stacks n frames before any of them return, so it uses O(n) space. Tail-call optimization could avoid that, but many languages do not do it.

## How

1. The same recurrence can be written as a loop or as recursion.
2. Prefer a loop when the depth would be large and the problem has no tree shape.
3. Prefer recursion when the problem is naturally a tree, as in tree algorithms or divide and conquer.

## Trap

Assuming recursion costs no extra memory.

**Fix:** Count the maximum recursion depth as space.

**Time:** usually the same for both · **Space:** recursion usually costs its depth

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
