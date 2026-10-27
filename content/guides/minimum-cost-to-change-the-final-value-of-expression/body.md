## Combine rules

Each operand is `(v, c)`: value and cost to flip it. A digit is `(d, 1)`.

- `&`: both 1 → `(1, min(c1, c2))`; both 0 → `(0, min(c1, c2) + 1)` (switch to `|` and flip one); mixed → `(0, 1)` (switch to `|`).
- `|`: both 0 → `(0, min(c1, c2))`; both 1 → `(1, min(c1, c2) + 1)`; mixed → `(1, 1)`.

Push a new frame on `(`; on `)`, pop its single result and combine it into the outer frame. The answer is the cost of the final pair.

`"1&(0|1)"` → 1. `"(0&0)&(0&0&0)"` → 3. `"(0|(1|0&1))"` → 1. Checked against brute force over all edit sets on random expressions.

Operators have equal precedence, so combine immediately as operands arrive. Changing one operator never costs more than 1, which is why mixed cases cost exactly 1.

Time: O(n)  
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
