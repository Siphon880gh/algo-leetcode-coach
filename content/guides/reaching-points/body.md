## The parent is unique

From `(x, y)`, the moves are `(x + y, y)` and `(x, x + y)`. Backward, the larger coordinate must have been the sum, so the parent of `(tx, ty)` is unique.

While `tx ≥ sx` and `ty ≥ sy`:

- If `tx == ty`, break (no valid parent).
- If `tx > ty`: if `ty == sy`, return `(tx − sx) % ty == 0`. Otherwise `tx %= ty`.
- Else: if `tx == sx`, return `(ty − sy) % tx == 0`. Otherwise `ty %= tx`.

Return `tx == sx and ty == sy`.

Modulo collapses many repeated subtractions into one step, so the loop runs like the Euclidean algorithm.

Do not search forward; the tree doubles each level. Do not use modulo blindly once a coordinate matches its start; that can overshoot below the start, which is why that case checks divisibility instead.

Time: O(log max(tx, ty))  
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
