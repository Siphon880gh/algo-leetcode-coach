A Fibonacci tree is built as order(0) = empty, order(1) = a single node, and order(n) = a root whose left subtree is order(n − 2) and right subtree is order(n − 1). Alice and Bob alternate turns, Alice first; a turn removes one node together with its whole subtree. The player forced to remove the root loses. Given n, return true if Alice wins with optimal play. For instance n = 1 → false, n = 2 → true, n = 3 → true. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Colon principle

Removing a non-root node cuts its subtree off, exactly like cutting an edge in Green Hackenbush; when only the root is left, the mover must take it and loses, which is "no move left".

1. `g(leaf) = 0`; `g(T) = XOR over children c of (g(c) + 1)`.
2. Fibonacci tree: `g(1) = 0`, `g(2) = 1`, `g(n) = (g(n − 2) + 1) XOR (g(n − 1) + 1)`.
3. The values run 0, 1, 3, 6, 3, 3, 0, 5, 7, 14, 7, 7, 0, … and are 0 exactly when `n % 6 == 1`.
4. Return `n % 6 != 1` (or compute `g(n) != 0` directly).

Constructed checks: a full game search agrees for n = 1 … 6, and the Grundy recurrence matches `n % 6 != 1` for n up to 80.

Alice moves first, so she wins iff the starting position has a nonzero Grundy value.

Time: O(1) (O(n) with the recurrence)  
Space: O(1)

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
