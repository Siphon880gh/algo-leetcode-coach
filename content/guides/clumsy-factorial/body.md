## Precedence with a stack

`stack = [n]`, `op = 0`. For `x` from `n − 1` down to 1:

- `op % 4 == 0` (`*`): `stack[-1] *= x`.
- `op % 4 == 1` (`/`): `stack[-1] = int(stack[-1] / x)` (truncate toward zero).
- `op % 4 == 2` (`+`): push `x`.
- `op % 4 == 3` (`−`): push `−x`.
- `op += 1`.

Return `sum(stack)`.

Pushing `−x` makes the later `*` and `/` apply to the negative group, which is right because they bind tighter than `−`.

There is also an O(1) pattern based on `n % 4`, but the stack version is easy to verify.

Do not evaluate left to right without precedence. Do not floor-divide negatives in Python (`//`); truncate toward zero.

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
