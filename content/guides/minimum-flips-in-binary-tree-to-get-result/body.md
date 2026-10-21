You are given the root of a binary tree in which every leaf holds false or true and every other node is an operator: OR, AND or XOR with two children, or NOT with one child, encoded by numbers that the statement defines. A node evaluates by applying its operator to its children’s values. You are also given a desired result. In one operation you may flip a leaf. Return the minimum number of flips so the root evaluates to result. For instance, AND(OR(true, false), NOT(true)) with result true → 1; OR(false, false) with result false → 0. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## (false cost, true cost)

1. Leaf with value `v`: cost `0` for `v`, `1` for the other.
2. NOT: swap the child’s pair. For children `(a0, a1)` and `(b0, b1)`:
   - OR: false `a0 + b0`; true `min(a1 + b0, a0 + b1, a1 + b1)`.
   - AND: false `min(a0 + b0, a0 + b1, a1 + b0)`; true `a1 + b1`.
   - XOR: false `min(a0 + b0, a1 + b1)`; true `min(a0 + b1, a1 + b0)`.
3. Return the root’s cost for `result`.

Constructed checks (verified against trying every leaf assignment on 500 random trees): the cases above → 1, 0.

Children are independent subtrees, so their costs add. Recursion depth equals tree height; use an explicit stack if the tree can be a long chain.

Time: O(n)  
Space: O(h)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
